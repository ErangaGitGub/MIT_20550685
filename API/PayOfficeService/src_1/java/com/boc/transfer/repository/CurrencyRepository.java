/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import com.boc.transfer.model.ChequeDeposit;
import java.util.Date;

/**
 *
 * @author it207458
 */
public class CurrencyRepository {

    private static String txnLibrary;
    Logger logger = Logger.getLogger(CurrencyRepository.class.getName());

    public String insertCurrency(String formJson) throws JSONException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
        String effectiveDate = getManDateFormatted();
        Connection con = null;
        Statement stmt = null;
        int[] result = null;
        JSONObject nObj = new JSONObject(formJson);
        JSONObject jSONResult = new JSONObject();
        ArrayList<String> resultArray = new ArrayList<String>();
        JSONArray nArray = new JSONArray();
        String key = null;
        String shrtCde = null;
        String nextKey = null;
        String shrtCdeNew = null;
        String buyRate = null;
        String sellRate = null;
        String celg = null;
        String indicative = null;
        String query = null;
        String user = nObj.getString("user");
        String ip = nObj.getString("ip");
        String host = nObj.getString("host");
        String middlerate = nObj.getString("middlerate");
        String remarks = nObj.getString("reason").toUpperCase();
        nObj.remove("user");
        nObj.remove("ip");
        nObj.remove("host");
        nObj.remove("middlerate");
        nObj.remove("reason");

        try {
            con = DbConnection.getConnection();
            stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                    ResultSet.CONCUR_UPDATABLE);
            //stmt = con.createStatement();
        } catch (SQLException e) {
            logger.error("Error in create connection : ", e);
        }

        try {
            nArray = nObj.names();
            ArrayList<String> alreadyUpdate = new ArrayList<String>();
            for (int i = 0; i < nArray.length(); i++) {

                key = nArray.getString(i);
                shrtCde = key.substring(2);
                nextKey = null;
                shrtCdeNew = null;

                for (int k = 0; k < nArray.length(); k++) {
                    nextKey = nArray.getString(k);
                    shrtCdeNew = nextKey.substring(2);
                    if (shrtCde.compareTo(shrtCdeNew) == 0) { //returns 0 if equal
                        resultArray.add(nextKey);
                    }
                    if (resultArray.size() == 4) {
                        alreadyUpdate.add(shrtCde);
                        break;

                    }
                }
                for (int j = 0; j < 4; j++) {
                    char first = (resultArray.get(j)).charAt(0);

                    switch (first) {
                        case 'B':
                            buyRate = nObj.getString(resultArray.get(j));
                            buyRate = buyRate.replaceFirst(",", "");

                            break;
                        case 'S':
                            sellRate = nObj.getString(resultArray.get(j));
                            sellRate = sellRate.replaceFirst(",", "");

                            break;
                        case 'C':
                            celg = nObj.getString(resultArray.get(j));
                            celg = celg.replaceFirst(",", "");

                            break;
                        case 'I':
                            indicative = nObj.getString(resultArray.get(j));
                            indicative = indicative.replaceFirst(",", "");

                            break;

                    }
                }
                resultArray.clear();
                if (checkCurrAdded(shrtCde, alreadyUpdate) == false) {

                    try {
                        if ("USD".equals(shrtCde)) {
                            query = "Update " + txnLibrary + ".PYT00701  set RTBUYRT = '" + buyRate + "',RTSELRT ='" + sellRate + "',RTCLING ='" + celg + "', RTINDRT = '" + indicative + "', RTSTATUS ='N', RTCRTUSR ='" + user + "',RTDATE ='" + effectiveDate + "',RTCRTTIM ='" + timeStamp + "',RTCRTIP ='" + ip + "', RTCRTHOST ='" + host + "', RTREMARKS ='" + remarks + "', RTMIDDLE ='" + middlerate + "'  where RTCURPET ='" + shrtCde + "' ";
                        } else {
                            query = "Update " + txnLibrary + ".PYT00701  set RTBUYRT = '" + buyRate + "',RTSELRT ='" + sellRate + "',RTCLING ='" + celg + "', RTINDRT = '" + indicative + "', RTSTATUS ='N', RTCRTUSR ='" + user + "',RTDATE ='" + effectiveDate + "',RTCRTTIM ='" + timeStamp + "',RTCRTIP ='" + ip + "', RTCRTHOST ='" + host + "', RTREMARKS ='" + remarks + "'  where RTCURPET ='" + shrtCde + "' ";
                        }
                        stmt.addBatch(query);
                    } catch (Exception e) {
                        logger.error("Error update to PYT00701 : ", e);
                    }
                }
            }//End of main loop
            int x = 0;
            try {
                result = stmt.executeBatch();
                con.commit();
                stmt.clearBatch();
                stmt.close();
                con.close();
                System.out.println("Number of rows inserted :" + result.length);

            } catch (Exception e) {
                logger.error("Error in Update CurrencyCodes in PYT00701: ", e);
            }

            if (result.length == 0) {
                resp = false;
            } else if (result.length > 0) {
                resp = true;
            }
            try {
                if (!resp) {
                    jSONResult.put("errorStatus", true);
                    jSONResult.put("errorMessage", "Error in Update currency  Data.");
                } else {
                    jSONResult.put("errorStatus", false);
                    jSONResult.put("errorMessage", "");
                }
            } catch (Exception e) {
                logger.error(e);
            }
        } catch (Exception e) {
            logger.error("Error in Update CurrencyCodes in PYT00701: ", e);
        }
        return jSONResult.toString();

    }

    private boolean checkCurrAdded(String shrtCde, ArrayList<String> arr) {
        boolean status = false;
        int x = 0;
        for (String a : arr) {
            if (a.equals(shrtCde)) {
                x++;
                if (x > 1) {
                    status = true;
                    break;
                }
            }
        }
        return status;
    }
    
    public String insertChequeData(ChequeDeposit chq) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        InsertTableData insertTableData = new InsertTableData();
        String query ="";
        JSONObject jSONObject = new JSONObject();
       
        try {
        
                try {
                    query = "INSERT INTO " + txnLibrary + ".PYP02201 "
                            + "(CHREFNO, CHCUSACC, CHCUSNAME, CHDRBNKCD, CHDRBRNCD, CHEFDATE, CHAMOUNT, CHCRTUSR, CHCRTIP, CHCRTHOST,CHCRTTIM  ) "
                            + " values ('"
                            + chq.getReference() + "', "
                            + chq.getAccount() + ", '"
                            + chq.getCustomername().toUpperCase() + "', "
                            + chq.getBankcode() + ", "
                            + chq.getBranchcode() + ", "
                            + getCurrentDateFormatted() + ", "
                            + chq.getAmount() + ", '"
                            + chq.getUser() + "', '"
                            + chq.getIpAddress() + "', '"
                            + chq.getHostname() + "', '"
                            + getCurrentTimeStamp() + "')";

                } catch (Exception e) {
                    logger.error("Error in insert data : ", e);
                }
                
                resp = insertTableData.insertTableData(query);

                
                try {
                    if (!resp) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("bankReference", "ERROR");
                        jSONObject.put("errorMessage", "Error in Save Cheque Details Data.");
                    } else {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("bankReference", chq.getReference());
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
              
           
        } catch (Exception e) { //Initial Catch
            logger.error("Error in Save Cheque Details", e);
        }

        return jSONObject.toString();
    }

    public String getRatesData(String printType) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadDataLibraty();
        String response = "";
        String datafetchquery = generateGetRatesDataQuery(printType);
        try {
            String query = datafetchquery;
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getRatesData from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getRatesData : ", e);
        }
        return response;
    }
    
    
    public String getChequeData() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String currentdate = getCurrentDateFormatted();
       
        try {
            String query = "select CHREFNO as REFNO,"
                    + "CHCUSACC as ACCOUNT , CHCUSNAME as NAME, CHDRBNKCD as BANKCODE, CHCRTUSR as USER, "
                    + "CHDRBRNCD as BRANCHCODE, "
                    + "CHAMOUNT as AMOUNT, CHCRTTIM as DATE "
                    + "from " + txnLibrary + ".PYP02201 where CHEFDATE = '" + currentdate + "'";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getChequeData from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getChequeData : ", e);
        }
        return response;
    }

    private String generateGetRatesDataQuery(String printType) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String effectiveDate = getManDateFormatted();
        String query = " ";
        switch (printType) {
            case "before_auth":
                query = "SELECT r.RTCURPET as curshrt, "
                        + "r.RTBUYRT as buyrate, "
                        + "r.RTSELRT as sellrate, "
                        + "r.RTINDRT as indicativerate, "
                        + "r.RTCLING as ceiling, "
                        + "r.RTMIDDLE as middlerate, "
                        + "r.RTSTATUS as status, "
                        + "r.RTREASON as reason, "
                        + "r.RTREMARKS as remarks, "
                        + "r.RTCRTUSR as createduser, "
                        + "r.RTCRTTIM as createdtime, "
                        + "c.CURIDNO as curid, "
                        + "c.CURDESC as curdesc "
                        + "FROM "
                        + txnLibrary + ".PYP00201 c, "
                        + txnLibrary + ".PYT00701 r "
                        + "WHERE "
                        + "c.CURSHRT = r.RTCURPET "
                        + "order by r.RTCURPET ";
                break;
            case "after_auth":
                query = "SELECT r.RPCURPET as curshrt, "
                        + "r.RPBUYRT as buyrate, "
                        + "r.RPSELRT as sellrate, "
                        + "r.RPINDRT as indicativerate, "
                        + "r.RPCLING as ceiling, "
                        + "r.RPMIDDLE as middlerate, "
                        + "r.RPSTAT as status, "
                        + "r.RPCRTUSR as createduser, "
                        + "r.RPCRTTIM as createdtime, "
                        + "r.RPAUTUSR as authorizeduser, "
                        + "r.RPAUTTIM as authorizedtime, "
                        + "c.CURIDNO as curid, "
                        + "c.CURDESC as curdesc "
                        + "FROM "
                        + txnLibrary + ".PYP00201 c, "
                        + txnLibrary + ".PYP007Z1 r "
                        + "WHERE "
                        + "c.CURSHRT = r.RPCURPET "
                        + " and RPDATE='" + effectiveDate + "' "
                        + " and RPSTAT = 'A' "
                        + " and RPAUTTIM = (select  max(RPAUTTIM) from  " + txnLibrary + ".pyp007Z1) ";
                       
                break;

        }
        return query;
    }

    public String authorizeRejectCurrency(String formJson) throws JSONException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        InsertTableData insertTableData = new InsertTableData();
        JSONObject jSONResult = new JSONObject();
        Statement stmt = null;
        boolean resp = false;
        int[] result = null;
        Connection con = null;
        JSONObject nObj = new JSONObject(formJson);
        String authUser = nObj.getString("user");
        String authIp = nObj.getString("ip");
        String authHost = nObj.getString("host");
        String status = nObj.getString("status");
        String reason = nObj.getString("reason").toUpperCase();
        String authTimeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
        // String effDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        String effDate = getManDateFormatted();
        String effTime = new SimpleDateFormat("HHmmss").format(new java.util.Date());
        try {
            con = DbConnection.getConnection();
            stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                    ResultSet.CONCUR_UPDATABLE);
            //stmt = con.createStatement();
        } catch (SQLException e) {
            logger.error("Error in create connection : ", e);
        }
        if (status.equals("A")) {
            try {
                String query = "insert into " + txnLibrary + ".PYP00701 "
                        + "(RPDATE, RPTIME, RPCURPET, RPBUYRT, RPSELRT, RPCLING, RPINDRT, RPMIDDLE, RPCRTUSR, RPCRTTIM, RPCRTIP, RPCRTHOST, RPAUTUSR, RPAUTTIM, RPAUTIP, RPAUTHOST, RPSTAT )"
                        + " select '" + effDate + "', '" + effTime + "', RTCURPET, RTBUYRT, RTSELRT, RTCLING, RTINDRT, RTMIDDLE, RTCRTUSR,RTCRTTIM, RTCRTIP, RTCRTHOST, '" + authUser + "', '" + authTimeStamp + "', '" + authIp + "', '" + authHost + "', 'A' "
                        + "from " + txnLibrary + ".PYT00701 ";

                stmt.addBatch(query);
            } catch (Exception e) {
                logger.error("Error insert to PYP00701 from PYT00701: ", e);
            }
            try {
                String query2 = "Update " + txnLibrary + ".PYT00701  set RTSTATUS = 'A'";

                stmt.addBatch(query2);
            } catch (Exception e) {
                logger.error("Error insert to PYP00701 from PYT00701: ", e);
            }
        } else if (status.equals("R")) {
            try {
                String query = "insert into " + txnLibrary + ".PYP00701 "
                        + "(RPDATE, RPTIME, RPCURPET, RPBUYRT, RPSELRT, RPCLING, RPINDRT, RPMIDDLE, RPCRTUSR, RPCRTTIM, RPCRTIP, RPCRTHOST, RPAUTUSR, RPAUTTIM, RPAUTIP, RPAUTHOST, RPSTAT )"
                        + " select '" + effDate + "', '" + effTime + "', RTCURPET, RTBUYRT, RTSELRT, RTCLING, RTINDRT, RTMIDDLE, RTCRTUSR,RTCRTTIM, RTCRTIP, RTCRTHOST, '" + authUser + "', '" + authTimeStamp + "', '" + authIp + "', '" + authHost + "', 'R' "
                        + "from " + txnLibrary + ".PYT00701 ";

                stmt.addBatch(query);
            } catch (Exception e) {
                logger.error("Error insert to PYP00701 from PYT00701: ", e);
            }
            try {
                String query2 = "Update " + txnLibrary + ".PYT00701  set RTSTATUS = 'R', RTREASON = '" + reason + "' ";

                stmt.addBatch(query2);
            } catch (Exception e) {
                logger.error("Error insert to PYP00701 from PYT00701: ", e);
            }
        }

        try {
            result = stmt.executeBatch();
            con.commit();
            stmt.clearBatch();
            stmt.close();
            con.close();
            System.out.println("Number of rows inserted :" + result.length);

        } catch (Exception e) {
            logger.error("Error in Copy CurrencyCodes to PYP00701: ", e);
        }
        if (result.length == 0) {
            resp = false;
        } else if (result.length > 0) {
            resp = true;
        }
        try {
            if (!resp) {
                jSONResult.put("errorStatus", true);
                jSONResult.put("errorMessage", "Error in Update currency  Data.");
            } else {
                jSONResult.put("errorStatus", false);
                jSONResult.put("errorMessage", "");
            }
        } catch (Exception e) {
            logger.error(e);
        }

        return jSONResult.toString();
    }

    private String getManDateFormatted() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy/MM/dd");
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String manDate = null;

        try {
            String query = "select MANDATE as date "
                    + "from " + txnLibrary + ".PYP00102 ";

            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                manDate = rs.getString("date");
            }
        } catch (Exception e) {
            logger.error("Error in get duplicate PF number : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in colose result set", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in colose statement", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }
        }

        return manDate;

    }
    
    private String getCurrentDateFormatted() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyyMMdd");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }
    
    private String getCurrentTimeStamp() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }
    
}
