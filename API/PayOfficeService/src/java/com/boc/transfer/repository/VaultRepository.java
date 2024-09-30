/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.model.ITRSInternationalTxn;
import com.boc.transfer.model.PermitionData;
import com.boc.transfer.model.UserData;
import java.io.InputStream;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Iterator;
import java.util.List;
import java.util.Properties;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import com.boc.transfer.model.AcceptCash;
import com.boc.transfer.model.CommissionRates;

/**
 *
 * @author it207458
 */
public class VaultRepository {

    private static String environmrnt, dataLibrary, txnLibrary, operatorLevel, bClassLevel, aClassLevel, dealer;
    Logger logger = Logger.getLogger(VaultRepository.class.getName());
    private int branchExists, userExists;

    private String getCurrentDateFormatted() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy/MM/dd");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }

    public String getCurrentDateTime() throws JSONException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy/MM/dd");
        LocalTime myObj = LocalTime.now();
        DateTimeFormatter nTime = DateTimeFormatter.ofPattern("HH:mm:ss");
        String strTime = myObj.format(nTime);
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String strDate = null;
        JSONObject jsonDateTime = new JSONObject();
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
                strDate = rs.getString("date");
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
        strDate = (strDate.substring(0, 4) + "/" + strDate.substring(4, 6) + "/" + strDate.substring(6, 8));
        jsonDateTime.put("date", strDate);
        jsonDateTime.put("time", strTime);
        jsonDateTime.put("dateTime", (strDate + " " + strTime));

        return jsonDateTime.toString();
    }

    public String getCurrencyList() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select CURIDNO as CURID, "
                    + "CURSHRT as CURSHRT, "
                    + "CURDESC as CURDESC "
                    + "from PYP00201 ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getCurrencyList from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getCurrencyList : ", e);
        }
        return response;
    }

    public String getPreviousDayOpeningBalance(String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select b.CURIDNO as CURID, a.TACURID as CURSHRT, B.CURDESC as CURDESC, "
                    + "A.TAOPNBAL as OPNBAL, A.TACURBAL as CURBAL "
                    + "FROM " + txnLibrary + ".PYp00601 a, " + txnLibrary + ".Pyp00201 b "
                    + "where a.TATILID ='" + tillID + "'   and a.TADATE ='" + getCurrentDateFormatted() + "'  "
                    + "and  a.TACURID=b.CURSHRT ";

            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getPreviousDayOpeningBalance from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getPreviousDayOpeningBalance : ", e);
        }
        return response;
    }

    public String getCurrencyListWithBalance(String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select b.CURIDNO as CURID, a.TPCURID as CURSHRT, B.CURDESC as CURDESC, "
                    + "A.TPCURBAL as CURBAL "
                    + "FROM PYT00601 a, PYP00201 b "
                    + "where a.TPTILID ='" + tillID + "'  and a.TPCURID=b.CURSHRT ";

            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getCurrencyListWithBalance from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getCurrencyListWithBalance : ", e);
        }
        return response;
    }

    public String insertToPOS(String formJson) throws JSONException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean result = false;
        JSONObject jSONObject = new JSONObject(formJson);
        JSONObject resultJson = new JSONObject();
        JSONArray jsonArray = new JSONArray();
        String amount = null;
        String key = null;
        Connection con = null;
        Statement stmt = null;
        boolean resp = false;
        int[] resultBatch = null;
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());

        try {
            con = DbConnection.getConnection();
            stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                    ResultSet.CONCUR_UPDATABLE);
            stmt = con.createStatement();
        } catch (SQLException e) {
            logger.error("Error in create connection : ", e);
        }

        try {
            String user = jSONObject.getString("user");
            String ip = jSONObject.getString("ip");
            String host = jSONObject.getString("host");
            String sourceTill = jSONObject.getString("sourceTill");
            String destTill = jSONObject.getString("destTill");

            jSONObject.remove("user");
            jSONObject.remove("ip");
            jSONObject.remove("host");
            jSONObject.remove("sourceTill");
            jSONObject.remove("destTill");

            jsonArray = jSONObject.names();
            try {
                for (int i = 0; i < jsonArray.length(); i++) {

                    key = jsonArray.getString(i);
                    amount = jSONObject.getString(key).trim();
                    double amountD = 0.0;
                   // amountD = Double.parseDouble(amount);
                    
                    if (amount.isEmpty()) {
                        resp = true;
                        resultJson.put("errorStatus", true);
                        resultJson.put("errorMessage", "Please enter amount for " + key);
                        break;
                    }
                    amountD = Double.parseDouble(amount);
                    if(amountD>0){
                    try {
                        String query1 = "INSERT INTO PYP00501 "
                                + "(TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR,TCCRTDAT, TCCRTIP, TCCRTHOST,TCSTATUS,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + sourceTill + "', '"
                                + destTill + "', '"
                                + key + "','"
                                + amount + "', '"
                                + user + "', '"
                                + getManDateFormatted() + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + "A', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query1);
                    } catch (Exception e) {
                        logger.error("Error in insert till data : ", e);
                    }

                    try {
                        String query2 = "Update PYT00601  set TPOPNBAL = TPOPNBAL + '" + amount + "',TPCURBAL = TPCURBAL + '" + amount + "'  where TPTILID ='" + destTill + "' and TPCURID = '" + key + "' ";

                        stmt.addBatch(query2);
                    } catch (Exception e) {
                        logger.error("Error in update till data : ", e);
                    }

                }
                }//end of if
            } catch (Exception e) {
                logger.error("Error in till to till: ", e);
            }
            if (resp == false) {
                try {

                    resultBatch = stmt.executeBatch();
                    con.commit();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows inserted :" + resultBatch.length);

                } catch (Exception e) {
                    logger.error("Error in Copy CurrencyCodes to PYP00701: ", e);
                }

                try {
                    if (resultBatch.length == 0) {
                        resultJson.put("errorStatus", true);
                    } else if (resultBatch.length > 0) {
                        resultJson.put("errorStatus", false);
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
            }
        } catch (Exception e) {
            logger.error("Error in till to till: ", e);
        }
        return resultJson.toString();
    }
    
    public String insertToT4S(String formJson) throws JSONException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean result = false;
        JSONObject jSONObject = new JSONObject(formJson);
        JSONObject resultJson = new JSONObject();
        JSONArray jsonArray = new JSONArray();
        String amount = null;
        String key = null;
        Connection con = null;
        Statement stmt = null;
        boolean resp = false;
        int[] resultBatch = null;
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());

        try {
            con = DbConnection.getConnection();
            stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                    ResultSet.CONCUR_UPDATABLE);
            stmt = con.createStatement();
        } catch (SQLException e) {
            logger.error("Error in create connection : ", e);
        }

        try {
            String user = jSONObject.getString("user");
            String ip = jSONObject.getString("ip");
            String host = jSONObject.getString("host");
            String sourceTill = jSONObject.getString("sourceTill");
            String destTill = jSONObject.getString("destTill");
            String remarks = jSONObject.getString("remarks");

            jSONObject.remove("user");
            jSONObject.remove("ip");
            jSONObject.remove("host");
            jSONObject.remove("sourceTill");
            jSONObject.remove("destTill");
            jSONObject.remove("remarks");

            jsonArray = jSONObject.names();
            try {
                for (int i = 0; i < jsonArray.length(); i++) {

                    key = jsonArray.getString(i);
                    amount = jSONObject.getString(key).trim();
                    double amountD = 0.0;
                    
                    if (amount.isEmpty()) {
                        resp = true;
                        resultJson.put("errorStatus", true);
                        resultJson.put("errorMessage", "Please enter amount for " + key);
                        break;
                    }
                    amountD = Double.parseDouble(amount);
                    
                    if(amountD>0){
                    result = checkTillValue(sourceTill, amount, key);
                    if (result == true) {
                        resp = true;
                        resultJson.put("errorStatus", true);
                        resultJson.put("errorMessage", "Source amount is not sufficient for " + key);
                        break;
                    } 
                   
                    try {
                        String query1 = "INSERT INTO PYP00501 "
                                + "(TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR,TCCRTDAT, TCCRTIP, TCCRTHOST,TCREMARKS,TCSTATUS,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + sourceTill + "', '"
                                + destTill + "', '"
                                + key + "','"
                                + amount + "', '"
                                + user + "', '"
                                + getManDateFormatted() + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + remarks + "', '"
                                + "A', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query1);
                    } catch (Exception e) {
                        logger.error("Error in insert till data : ", e);
                    }

                    try {
                        String query2 = "Update PYT00601  set TPCASHOU = TPCASHOU + '" + amount + "',TPCURBAL = TPCURBAL - '" + amount + "'  where TPTILID ='" + sourceTill + "' and TPCURID = '" + key + "' ";

                        stmt.addBatch(query2);
                    } catch (Exception e) {
                        logger.error("Error in update till data : ", e);
                    }

                }
                }
                
                //

            } catch (Exception e) {
                logger.error("Error in till to till: ", e);
            }
            if (resp == false) {
                try {

                    resultBatch = stmt.executeBatch();
                    con.commit();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows inserted :" + resultBatch.length);

                } catch (Exception e) {
                    logger.error("Error in Copy CurrencyCodes to PYP00701: ", e);
                }

                try {
                    if (resultBatch.length == 0) {
                        resultJson.put("errorStatus", true);
                    } else if (resultBatch.length > 0) {
                        resultJson.put("errorStatus", false);
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
            }
        } catch (Exception e) {
            logger.error("Error in till to till: ", e);
        }
        return resultJson.toString();
    }

    public String tillToTill(String formJson) throws JSONException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean result = false;
        JSONObject jSONObject = new JSONObject(formJson);
        JSONObject resultJson = new JSONObject();
        JSONArray jsonArray = new JSONArray();
        String amount = null;
        String key = null;
        Connection con = null;
        Statement stmt = null;
        boolean resp = false;
        int[] resultBatch = null;
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());

        try {
            con = DbConnection.getConnection();
            stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                    ResultSet.CONCUR_UPDATABLE);
            stmt = con.createStatement();
        } catch (SQLException e) {
            logger.error("Error in create connection : ", e);
        }

        try {
            String user = jSONObject.getString("user");
            String ip = jSONObject.getString("ip");
            String host = jSONObject.getString("host");
            String sourceTill = jSONObject.getString("sourceTill");
            String destTill = jSONObject.getString("destTill");

            jSONObject.remove("user");
            jSONObject.remove("ip");
            jSONObject.remove("host");
            jSONObject.remove("sourceTill");
            jSONObject.remove("destTill");

            jsonArray = jSONObject.names();
            try {
                for (int i = 0; i < jsonArray.length(); i++) {

                    key = jsonArray.getString(i);
                    amount = jSONObject.getString(key);
                    double amountD = 0.0;
                    if (amount.isEmpty()) {
                        resp = true;
                        resultJson.put("errorStatus", true);
                        resultJson.put("errorMessage", "Please enter amount for " + key);
                        break;
                    }
                    amountD = Double.parseDouble(amount);
                    
                    if(amountD>0){
                    result = checkTillValue(sourceTill, amount, key);
                    if (result == true) {
                        resp = true;
                        resultJson.put("errorStatus", true);
                        resultJson.put("errorMessage", "Source amount is not sufficient for " + key);
                        break;
                    } 
                    
                    try {
                        String query1 = "INSERT INTO PYP00501 "
                                + "(TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR,TCCRTDAT, TCCRTIP, TCCRTHOST,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + sourceTill + "', '"
                                + destTill + "', '"
                                + key + "','"
                                + amount + "', '"
                                + user + "', '"
                                + getManDateFormatted() + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query1);
                    } catch (Exception e) {
                        logger.error("Error in insert till data : ", e);
                    }

//                    // if (result == true) {
//                    try {
//                        String query3 = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + amount + "' where TPTILID ='" + destTill + "' and TPCURID = '" + key + "' ";
//
//                        stmt.addBatch(query3);
//                    } catch (Exception e) {
//                        logger.error("Error in update till data : ", e);
//                    }
                    }//end of if
                    }

            } catch (Exception e) {
                logger.error("Error in till to till: ", e);
            }
            //if ((result == false)&&(resp=false)) {
            if ((resp == false)) {
                try {
                    resultBatch = stmt.executeBatch();
                    con.commit();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows inserted :" + resultBatch.length);

                } catch (Exception e) {
                    logger.error("Error in Copy CurrencyCodes to PYP00701: ", e);
                }
                //}
            }
        } catch (Exception e) {
            logger.error("Error in till to till: ", e);
        }
        if ((resp == false)) {
            try {
                if (resultBatch.length == 0) {
                    resultJson.put("errorStatus", true);
                } else if (resultBatch.length > 0) {
                    resultJson.put("errorStatus", false);
                }
            } catch (Exception e) {
                logger.error(e);
            }
        }
        return resultJson.toString();
    }

    public boolean checkTillValue(String sourceTill, String amount, String key) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean response = false;
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;

        try {
            String query = "select TPCURBAL as tillAmount "
                    + "from PYT00601 "
                    // + "where TPTILID like '%" + sourceTill + "%' and TPCURID = '"+key+"' ";
                    + "where TPTILID = '" + sourceTill + "' and TPCURID = '" + key + "' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                if (Double.parseDouble(amount) > (Double.parseDouble(rs.getString("tillAmount")))) {
                    response = true;
                } else {
                    response = false;
                }
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
        return response;
    }

    public String getTillBalance(String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String currentDate = new SimpleDateFormat("yyyy-MM-dd").format(new java.util.Date());
        //String currentDate = "2022-07-19";
        try {
            String query = "select a.TPCURID, a.TPCURBAL, b.CURDESC "
                    + " from PYT00601 a, PYP00201 b "
                    + "where TPTILID = '" + tillID + "' and a.TPCURID=b.CURSHRT  ";
            GetTableData tableData = new GetTableData();
            response = tableData.getDBData(query);
        } catch (Exception e) {
            logger.error("Error in getPendingTransfers from DB : ", e);
        }

        return response;
    }

    public String getPendingTransfers(String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String currentDate = getManDateFormatted();
        //String currentDate = "2022-07-19";
        try {
            String query = "select a.TCCURID,a.TCSRCTIL,a.TCDESTIL,a.TCTRAMNT,a.TCCRTUSR,a.TCCRTTIM, b.TILDESC "
                    + "from PYP00501 a, PYP00401 b where TCDESTIL = '" + tillID + "' and TCSRCTIL != '" + tillID + "' "
                    + "and TCCRTDAT = '" + currentDate + "' and TCSTATUS = '' and TCTRAMNT>0 "
                    + " and b.TILIDNO= a.TCSRCTIL ";
            GetTableData tableData = new GetTableData();
            response = tableData.getDBData(query);
        } catch (Exception e) {
            logger.error("Error in getPendingTransfers from DB : ", e);
        }

        return response;
    }

    public String acceptRejectAllTransfers(String tillID, String action) throws ClassNotFoundException, JSONException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String currentDate = getManDateFormatted();
        //String currentDate = "2022-07-19";
        List<AcceptCash> acceptCash = new ArrayList<>();
        txnLibrary = library.loadTxnLibraty();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String error = null;
        JSONObject jSon = new JSONObject();
        String eMessage = null;
        String eStatus = null;
        try {
            String query = "select a.TCCURID,a.TCSRCTIL,a.TCDESTIL,a.TCTRAMNT,a.TCCRTUSR,a.TCCRTTIM, b.TILDESC "
                    + "from PYP00501 a, PYP00401 b where TCDESTIL = '" + tillID + "' and TCSRCTIL != '" + tillID + "' "
                    + "and TCCRTDAT = '" + currentDate + "' and TCSTATUS = '' and TCTRAMNT>0 "
                    + " and b.TILIDNO= a.TCSRCTIL ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(query);
                while (rs.next()) {
                    AcceptCash aCash = new AcceptCash();
                    aCash.setFromTill(rs.getString("TCSRCTIL"));
                    aCash.setCurr(rs.getString("TCCURID"));
                    aCash.setAmount(rs.getDouble("TCTRAMNT"));
                    aCash.setTrnUsr(rs.getString("TCCRTUSR"));
                    aCash.setTrnTime(rs.getString("TCCRTTIM"));
                    aCash.setDstTill(tillID);
                    acceptCash.add(aCash);
                }
            } catch (SQLException Ex) {
                logger.error("Error get commission Rates data : ", Ex);
            }

            for (int i = 0; i < acceptCash.size(); i++) {

                error = acceptCashToTill(acceptCash.get(i).getFromTill(), tillID, acceptCash.get(i).getCurr(), String.valueOf(acceptCash.get(i).getAmount()), acceptCash.get(i).getTrnUsr(), acceptCash.get(i).getTrnTime(), action);
                JSONObject jError = new JSONObject(error);
                if (jError.getString("errorLetter").equalsIgnoreCase("X")) {
                    jSon.put("errorMessage", jError.getString("errorMessage"));
                    jSon.put("status", jError.getString("status"));
                    jSon.put("errorStatus", true);
                    break;
                } else {
                    jSon.put("status", jError.getString("status"));
                    jSon.put("errorStatus",false);
                }
            }

        } catch (Exception e) {
            logger.error("Error get commission Rates data : ", e);
        }
        return error;
    }

    public String getCashTransfers(String tillID, String type) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        
        String query = generategetCashTransferQuery(tillID,type);
        try {
            GetTableData tableData = new GetTableData();
            response = tableData.getDBData(query);
        } catch (Exception e) {
            logger.error("Error in getPendingTransfers from DB : ", e);
        }

        return response;
    }
    
    private String generategetCashTransferQuery(String tillID, String type) {
        String query = " ";
        String currentDate = getManDateFormatted();
        
        switch (type) {
            case "I":
                query =  "select a.TCCURID,a.TCSRCTIL,a.TCDESTIL,a.TCTRAMNT,a.TCCRTUSR,a.TCCRTTIM, a.TCSTATUS, b.TILDESC "
                    + "from PYP00501 a, PYP00401 b where TCSRCTIL = '" + tillID + "' "
                    + "and TCCRTDAT = '" + currentDate + "'  and TCTRAMNT>0 "
                    + " and b.TILIDNO= a.TCDESTIL ";
                break;
            case "R":
                 query = "select a.TCCURID,a.TCSRCTIL,a.TCDESTIL,a.TCTRAMNT,a.TCCRTUSR,a.TCCRTTIM,a.TCSTATUS, b.TILDESC "
                    + "from PYP00501 a, PYP00401 b where TCDESTIL = '" + tillID + "' and TCSRCTIL != '" + tillID + "' "
                    + "and TCCRTDAT = '" + currentDate + "' and (TCSTATUS = 'A' OR TCSTATUS = 'R') and TCTRAMNT>0 "
                    + " and b.TILIDNO= a.TCSRCTIL ";
                break;
            
        }
        
        return query;
    }

    public String acceptCashToTill(String sourceTill, String destTill, String curr, String amount, String user, String timestamp, String status) throws ClassNotFoundException, JSONException {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        boolean result = false;
        Statement stmnt = null;
        JSONObject jSONObject = new JSONObject();
        int[] resultBatch = null;
        Connection con = null;
        if (status.equalsIgnoreCase("A")) {
            result = checkTillValue(sourceTill, amount, curr);
            if (result == true) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("status", "A");
                jSONObject.put("errorLetter", "X");
                jSONObject.put("errorMessage", "Source till balance is not sufficient to accept transfer");
            } else {

                try {
                    con = DbConnection.getConnection();
                    stmnt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                            ResultSet.CONCUR_UPDATABLE);
                    stmnt = con.createStatement();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }

                try {
                    String query = "UPDATE PYP00501 "
                            + " SET TCSTATUS='A' WHERE TCSRCTIL = '" + sourceTill + "' and TCDESTIL = '" + destTill + "'  "
                            + " and TCCURID = '" + curr + "' and TCTRAMNT = '" + amount + "' and  TCCRTTIM = '" + timestamp + "' ";
                    stmnt.addBatch(query);
                } catch (Exception e) {
                    logger.error("Error in remove user data : ", e);
                }
                try {
                    String query2 = "Update PYT00601  set TPCURBAL = TPCURBAL - '" + amount + "' where TPTILID ='" + sourceTill + "' and TPCURID = '" + curr + "' ";

                    stmnt.addBatch(query2);
                } catch (Exception e) {
                    logger.error("Error in update till data : ", e);
                }

                try {
                    String query3 = "Update PYT00601  set TPCURBAL = TPCURBAL + '" + amount + "' where TPTILID ='" + destTill + "' and TPCURID = '" + curr + "' ";

                    stmnt.addBatch(query3);
                } catch (Exception e) {
                    logger.error("Error in update till data : ", e);
                }
                try {

                    resultBatch = stmnt.executeBatch();
                    con.commit();
                    stmnt.clearBatch();
                    stmnt.close();
                    System.out.println("Number of rows inserted :" + resultBatch.length);

                } catch (Exception e) {
                    logger.error("Error in Copy CurrencyCodes to PYP00701: ", e);
                }
                try {
                    if (resultBatch.length == 0) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("status", "A");
                        jSONObject.put("errorLetter", "X");
                    } else if (resultBatch.length > 0) {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("status", "A");
                        jSONObject.put("errorLetter", "Y");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }

            }
        } /// End of authorize
        if (status.equalsIgnoreCase("R")) {
            try {
                String query = "UPDATE PYP00501 "
                        + " SET TCSTATUS='R' WHERE TCSRCTIL = '" + sourceTill + "' and TCDESTIL = '" + destTill + "'  "
                        + " and TCCURID = '" + curr + "' and TCTRAMNT = '" + amount + "' and  TCCRTTIM = '" + timestamp + "' ";
                resp = insertTableData.insertTableData(query);
            } catch (Exception e) {
                logger.error("Error in remove user data : ", e);
            }

            try {
                if (!resp) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("status", "R");
                    jSONObject.put("errorLetter", "X");

                } else {
                    jSONObject.put("errorStatus", false);
                    jSONObject.put("status", "R");
                    jSONObject.put("errorLetter", "Y");
                }
            } catch (Exception e) {
                logger.error(e);
            }
        }
        return jSONObject.toString();
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
                    + "from PYP00102 ";

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
}
