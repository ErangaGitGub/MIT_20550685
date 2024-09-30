/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.model.CommissionRates;
import com.boc.transfer.model.CurrencyAmounts;
import com.boc.transfer.model.ITRSInternationalTxn;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.time.LocalTime;
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Date;
import java.util.List;
import org.apache.log4j.Logger;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author it207416
 */
public class TransactionRepository {

    Logger logger = Logger.getLogger(TransactionRepository.class.getName());
    private static String dataLibrary;
    private static String txnLibrary;

    public String getCustomerData(String uinType, String uinNumber) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        JSONObject resultJson = new JSONObject();
        boolean errorStatus = true;
        try {
            String query = "select CUNA1 as NAME,"
                    + "CUNA2 as ADD1 , CUNA3 as ADD2, CUNA4 as ADD3, CUNA5 as ADD4, "
                    + "CUCPSP as PASSPORT, CUNTID as NIC, CUCPRF as STAFF "
                    + "from " + dataLibrary + ".CUP003 where CUNTID ='" + uinNumber + "'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                resultJson.put("customerName", rs.getString("NAME"));
                resultJson.put("addressLine1", rs.getString("ADD1"));
                resultJson.put("addressLine2", rs.getString("ADD2"));
                resultJson.put("addressLine3", rs.getString("ADD3"));
                resultJson.put("addressLine4", rs.getString("ADD4"));
                resultJson.put("passport", rs.getString("PASSPORT"));
                resultJson.put("nic", rs.getString("NIC"));
                resultJson.put("staff", rs.getString("STAFF"));
                errorStatus = false;
            }
            resultJson.put("error_status", errorStatus);
        } catch (Exception e) {
            logger.error("Error in getting customer data : ", e);
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
        return resultJson.toString();
    }

    public String getCurrencyData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select GCCODE,GCPET  "
                    + "from " + dataLibrary + ".GLC001 where GCCODE <> 0";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Currency details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Currency data : ", e);
        }
        return response;
    }

    public String getExchangeRate(String currency, String shortcode, String txntype) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        String query = null;
        JSONObject resultJson = new JSONObject();
        String currentDate = getManDateFormatted();

//        String currentDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        try {
//            if ("FCI".equals(txntype)){
//                
//                query = "select GBVAR as ceiling, GBBKXR - GBNOBS as buyRate, GBBKXR + GBNOSS as sellRate from "
//                    + "("
//                    + "select " + dataLibrary + ".GLC002.*, "
//                    + "       ROW_NUMBER() "
//                    + "       OVER ( PARTITION BY GBCODE  "
//                    + "              ORDER BY GBUPDT DESC, "
//                    + "              GBUPTM DESC) rn "
//                    + "from " + dataLibrary + ".GLC002 "
//                    + ") "
//                    + " t1 where rn=1 and GBCODE ='" + currency + "'";
//        
//            } else {

            query = "select RPBUYRT as buyRate,RPSELRT as sellRate, RPCLING as ceiling,RPCURPET as currShrt from "
                    + " " + txnLibrary + ".PYP00701 where RPSTAT = 'A' and RPCURPET = '" + shortcode + "' and "
                    + " RPDATE = '" + currentDate + "' and RPCRTTIM = (select  max(RPCRTTIM) from  " + txnLibrary + ".pyp00701 where RPDATE = '" + currentDate + "')";
                    

            //}
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                resultJson.put("ceiling", rs.getString("CEILING"));
                resultJson.put("buyRate", rs.getString("BUYRATE"));
                resultJson.put("sellRate", rs.getString("SELLRATE"));
            }
            //resultJson.put("crossRate", getUSDCrossRate(shortcode));
        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
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
        return resultJson.toString();
    }

    public String getCountryData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select CNTID as ID, "
                    + "CNTCODE as CODE, "
                    + "CNTNAME as NAME "
                    + "from " + dataLibrary + ".ITRSCNT001 "
                    + "where CNTSTAT ='A'";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Country details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Country data : ", e);
        }
        return response;
    }

    public String getTransactionCodesData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select NOTID,NOTNAME  "
                    + "from " + dataLibrary + ".ITRSNOT001";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get transaction codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load transaction codes data : ", e);
        }
        return response;
    }

    public String getAllITRSCodesData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select ITRSCODE as code,ITRSCODENM as name  "
                    + "from " + dataLibrary + ".ITRSCOD001";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get all ITRS codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load all ITRS codes data : ", e);
        }
        return response;
    }

    public String getITRSCodesData(String txncode) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        String whereClause = generateITRSCodesListWhereClause(txncode);
        try {
            String query = "select t.ITRSCODE as code, t.ITRSCDESC as name "
                    + "from " + dataLibrary + ".ITRSCOD001 t, " + dataLibrary + ".IEP00401 p "
                    + whereClause;
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get itrs codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load itrs codes data : ", e);
        }
        return response;
    }

    private String generateITRSCodesListWhereClause(String txncode) {
        String whereClause = " ";

        switch (txncode) {
            case "1":
                whereClause = "WHERE   p.ITNATTXN = '1'  and p.ITRSCODE = t.ITRSCID ";
                break;
            case "2":
                whereClause = "WHERE   p.ITNATTXN = '2'  and p.ITRSCODE = t.ITRSCID  ";
                break;
//              
            case "3":
                whereClause = "WHERE   p.ITNATTXN = '1'   and p.ITRSCODE = t.ITRSCID ";
                break;

        }

        return whereClause;
    }

    public String getAccountTypeCodesData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select ATCCODE as code, "
                    + "SUBSTRING(ATCDESC, 1, 60) as name "
                    + "from " + dataLibrary + ".ITRSATC001";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get account type codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load account type code data : ", e);
        }
        return response;
    }

    public String getTransactionSectorCodesData(String uintype) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        String whereClause = generateSectorCodesListWhereClause(uintype);
        try {

            String query = "select TRSCODE as code, "
                    + "TRSNAME as name "
                    + "from " + dataLibrary + ".ITRSTRS001 "
                    + whereClause;
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Transaction Sector codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Transaction Sector codes data : ", e);
        }
        return response;
    }

    private String generateSectorCodesListWhereClause(String uintype) {
        String whereClause = " ";
        switch (uintype) {
            case "1":
                whereClause = "WHERE  TRSUINC = 1 ";
                break;
            case "2":
                whereClause = "WHERE  TRSUINC = 2 ";
                break;

            case "3":
                whereClause = "WHERE  TRSUINC = 3 ";
                break;
            case "4":
                whereClause = "WHERE  TRSUINC = 4 ";
                break;
            case "5":
                whereClause = "WHERE  TRSUINC = 1 ";
                break;
        }
        return whereClause;
    }

    public String getBankCodesData() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select BNKCODE as code, "
                    + "BNKNAME as name "
                    + "from " + dataLibrary + ".ITRSBNK001";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Bank codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Bank codes data : ", e);
        }
        return response;
    }

    public String getRemmitanceData(JSONObject wrkRemJson) {
        boolean error_status = true;
        JSONObject resultJson = new JSONObject();
        try {
            if (!wrkRemJson.isNull("currency1") && !wrkRemJson.isNull("amount1")) {
                String wrkrem = calculateWorkerRemittance(wrkRemJson.getString("currency1"), wrkRemJson.getString("amount1"));
                if (!"".equals(wrkrem)) {
                    error_status = false;
                    resultJson.put("currency1", wrkrem);
                }
            } else {
                resultJson.put("currency1", "0");
            }
            if (!wrkRemJson.isNull("currency2") && !wrkRemJson.isNull("amount2")) {
                String wrkrem = calculateWorkerRemittance(wrkRemJson.getString("currency2"), wrkRemJson.getString("amount2"));
                if (!"".equals(wrkrem)) {
                    error_status = false;
                    resultJson.put("currency2", wrkrem);
                }
            } else {
                resultJson.put("currency2", "0");
            }
            if (!wrkRemJson.isNull("currency3") && !wrkRemJson.isNull("amount3")) {
                String wrkrem = calculateWorkerRemittance(wrkRemJson.getString("currency3"), wrkRemJson.getString("amount3"));
                if (!"".equals(wrkrem)) {
                    error_status = false;
                    resultJson.put("currency3", wrkrem);
                }
            } else {
                resultJson.put("currency3", "0");
            }
            if (!wrkRemJson.isNull("currency4") && !wrkRemJson.isNull("amount4")) {
                String wrkrem = calculateWorkerRemittance(wrkRemJson.getString("currency4"), wrkRemJson.getString("amount4"));
                if (!"".equals(wrkrem)) {
                    error_status = false;
                    resultJson.put("currency4", wrkrem);
                }
            } else {
                resultJson.put("currency4", "0");
            }
            resultJson.put("error_status", error_status);
        } catch (JSONException e) {
            logger.error("Error in load Bank codes data : ", e);
        }
        return resultJson.toString();
    }

    private String calculateWorkerRemittance(String currency, String amount) {

//        double middlerate = Double.valueOf(getMiddleRate());
//        double indicativerate = Double.valueOf(getIndicativeRate(currency));        
//        double amountD = Double.valueOf(amount);
        String wrkrem = "0";
//        if ("USD".equals(currency)) {
//            wrkrem = String.valueOf(amountD * 0);
//        } else {            
//            wrkrem = String.valueOf((amountD * indicativerate * 0) / middlerate);
//        }

        return wrkrem;
    }

    public String getIndicativeRate(String currency) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        String indicativeRate = "";
        String currentDate = getManDateFormatted();
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();

        try {
            String query = "select RPINDRT as indicativeRate  "
                    + "from " + txnLibrary + ".PYP00701 "
                    + "where RPCRTTIM = (select  max(RPCRTTIM) from  " + txnLibrary + ".pyp00701) "
                    + "and RPDATE = '" + currentDate + "' and RPSTAT = 'A' "
                    + "and RPCURPET = '" + currency + "'";

            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                indicativeRate = rs.getString("indicativeRate");
            }

        } catch (Exception e) {
            logger.error("Error in getCurrencyCode : ", e);
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
        return indicativeRate;
    }

    private String getMiddleRate() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        String middleRate = "";
        String currentDate = getManDateFormatted();
//        String currentDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        try {
            String query = "select RPMIDDLE as middlerate  "
                    + "from " + txnLibrary + ".PYP00701 "
                    + "where RPCRTTIM = (select  max(RPCRTTIM) from  " + txnLibrary + ".pyp00701) "
                    + "and RPDATE = '" + currentDate + "' and RPSTAT = 'A' "
                    + "and RPCURPET = 'USD'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                middleRate = rs.getString("middlerate");
            }
        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
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
        return middleRate;
    }

    public String getCurrencyCode(String currency) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        String currencyCode = "";
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();

        try {
            String query = "select GCCODE as currencyCode "
                    + "from " + dataLibrary + ".glc001 "
                    + "where GCPET = '" + currency + "'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                currencyCode = rs.getString("currencyCode");
            }

        } catch (Exception e) {
            logger.error("Error in getCurrencyCode : ", e);
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
        return currencyCode;
    }

    private String getCurrentDateFormatted() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy/MM/dd");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
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

    private String getManDateServersTime() throws JSONException {
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

    public String getAccountData(String accnumber) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadDataLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        JSONObject resultJson = new JSONObject();
        JSONObject resultJsonTwo = new JSONObject();
        boolean errorStatus = true;
        try {
            String query = generateaccountDataFetchQuery(accnumber);
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                resultJson.put("customerName", rs.getString("NAME"));
                resultJson.put("balance", rs.getString("BALANCE"));
                resultJson.put("currency", rs.getString("CURRENCY"));
                resultJson.put("status", rs.getString("STATUS"));
                errorStatus = false;
            }
            resultJson.put("error_status", errorStatus);

        } catch (Exception e) {
            logger.error("Error in getting account data : ", e);
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
        return resultJson.toString();
    }

    private String generateaccountDataFetchQuery(String accnumber) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String query = " SELECT b.CUNA1 as name , c.DMCBAL - c.DMHOLD as balance, d.GCPET as currency, c.DMSTAT as status "
                + "FROM "
                + dataLibrary + ".cup009z10 a, "
                + dataLibrary + ".cup00301 b, "
                + dataLibrary + ".tap00201 c, "
                + dataLibrary + ".glc001 d "
                + "WHERE "
                + "a.CCUX1AC = LPAD(" + accnumber + ", 10, '0') and "
                + "A.CUX1AP = 20 and "
                + "c.DMACCT = " + accnumber + " and "
                + "A.CUX1CS= B.CUNBR and "
                + "C.DMCMCN = D.GCCODE ";

        return query;
    }


    
    public String insertData(ITRSInternationalTxn txn) {
        logger.debug("07_INIT_INSERTDATA_REPO"+ getCurrentTimeStamp());
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String toAccount = library.loadToAccount();
        String toAcctType = library.loadToAccType();
        String curCode = library.loadcurCode();
        Double totComm = 0.0;
        boolean resp = false;
        boolean respQuery = false;
        JSONObject jSONObject = new JSONObject();
        String query = null;
        String accType = null;
        String[] s = new String[3];
        Statement stmt = null;
        int[] result = null;
        Connection con = null;
        InsertTableData insertTableData = new InsertTableData();
        try {
            if (checkTillAmount(txn.getUserTill(), txn.getIcurrencyselector1(), txn.getIcurrencyselector2(), txn.getIcurrencyselector3(), txn.getIcurrencyselector4(), txn.getTamount1(), txn.getTamount2(), txn.getTamount3(), txn.getTamount4(), txn.getTransactionType(), txn.getTotalLKR()) == true) {
                try {
                    query = "INSERT INTO " + txnLibrary + ".PYP00301 "
                            + "(TRUINCOD, TREFDATE, TRTXNTYP, TRUINNUM, TRACCNUM, TRNAME, TRBRNCOD, TRBNKCOD, TRPASSPO, "
                            + " TRCRTUSR, TRIPADDR, TRHOSTNM, TRTIMEST, TRREFNUM, TRREMARK, TRAIRTKT, TRREFPRV, "
                            + " TRNATXCD, TRACTYCD, TRTXSECD, TRITRSCD, TRISFXCV, TRCOUNTR, "
                            + " TRCURR1, TRAMT1, TREXRAT1,TRNMRAT1, TRCVAMT1, TRINAMT1, TRUSDRT1, TRUSDEQ1, "
                            + " TRCURR2, TRAMT2, TREXRAT2,TRNMRAT2, TRCVAMT2, TRINAMT2, TRUSDRT2, TRUSDEQ2, "
                            + " TRCURR3, TRAMT3, TREXRAT3,TRNMRAT3, TRCVAMT3, TRINAMT3, TRUSDRT3, TRUSDEQ3, "
                            + " TRCURR4, TRAMT4, TREXRAT4,TRNMRAT4  , TRCVAMT4, TRINAMT4, TRUSDRT4, TRUSDEQ4, "
                            + " TRCOMPER, TRCOMAMT, TRLKRTOT, TRINCAMT, TRCOMFCA, TRCUSTOT,TRRECAMT, TRREFAMT, "
                            + " TRBENAME, TRADDRES, TRBECNTR, TRUSRTIL, TRBERMBK ) "
                            + " values ("
                            + txn.getUincode() + ", "
                            + getManDateFormatted() + ", '"
                            + txn.getTransactionType() + "', '"
                            + txn.getUinnumber().toUpperCase() + "', '"
                            + txn.getAccountNo() + "', '"
                            + txn.getTitle().toUpperCase() + "." + txn.getFname().toUpperCase() + "', '"
                            + txn.getBranchCode() + "', '"
                            + "7010', '"
                            + txn.getPassportNo() + "', '"
                            + txn.getUser() + "', '"
                            + txn.getIpAddress() + "', '"
                            + txn.getHostname() + "', '"
                            + getCurrentTimeStamp() + "', '"
                            + txn.getReferenceNo() + "', '"
                            + txn.getRemarks() + "', '"
                            + txn.getAirTicketNo() + "', '"
                            + txn.getPreviousReceiptNo() + "', "
                            + txn.getNatureOfTxnCode() + ", "
                            + txn.getAccounttypecode() + ", "
                            + txn.getSectorcode() + ", "
                            + txn.getItrscode() + ", "
                            + " 'Y', '"
                            + txn.getMajorcountry() + "', '"
                            + txn.getIcurrencyselector1() + "', "
                            + txn.getTamount1() + ", "
                            + txn.getRate1().replaceFirst(",", "") + ", "
                            + txn.getDefaultRate1().replaceFirst(",", "") + ", "
                            + txn.getCamount1() + ", "
                            + txn.getIncentiveAmount1() + ", "
                            + txn.getUsdCrossRate1() + ", "
                            + txn.getUsdEqvAmount1() + ", '"
                            + txn.getIcurrencyselector2() + "', "
                            + txn.getTamount2() + ", "
                            + txn.getRate2().replaceFirst(",", "") + ", "
                             + txn.getDefaultRate2().replaceFirst(",", "") + ", "
                            + txn.getCamount2() + ", "
                            + txn.getIncentiveAmount2() + ", "
                            + txn.getUsdCrossRate2() + ", "
                            + txn.getUsdEqvAmount2() + ", '"
                            + txn.getIcurrencyselector3() + "', "
                            + txn.getTamount3() + ", "
                            + txn.getRate3().replaceFirst(",", "") + ", "
                             + txn.getDefaultRate3().replaceFirst(",", "") + ", "
                            + txn.getCamount3() + ", "
                            + txn.getIncentiveAmount3() + ", "
                            + txn.getUsdCrossRate3() + ", "
                            + txn.getUsdEqvAmount3() + ", '"
                            + txn.getIcurrencyselector4() + "', "
                            + txn.getTamount4() + ", "
                            + txn.getRate4().replaceFirst(",", "") + ", "
                             + txn.getDefaultRate4().replaceFirst(",", "") + ", "
                            + txn.getCamount4() + ", "
                            + txn.getIncentiveAmount4() + ", "
                            + txn.getUsdCrossRate4() + ", "
                            + txn.getUsdEqvAmount4() + ", "
                            + txn.getCommissionPercentage() + ", "
                            + txn.getCommissionAmount() + ", "
                            + txn.getTotalLKR() + ", "
                            + txn.getTotalIncentive() + ", "
                            + txn.getCeilingOrFloorCommission() + ", "
                            + txn.getTotalToCustomer() + ", "
                            + txn.getReceivedAmount() + ", "
                            + txn.getRefundAmount() + ", '"
                            + txn.getBenename() + "', '"
                            + txn.getCustaddr1() + "', '"
                            + txn.getBenecountry() + "', "
                            + txn.getUserTill() + ", "
                            + txn.getBenebank() + ")";
                    respQuery = insertTableData.insertTableData(query);

                } catch (Exception e) {
                    logger.error("Error in insert data : ", e);
                }

             if(respQuery==true)  { 
             try {

                    if (txn.getTransactionType().equalsIgnoreCase("FCI")) {
                        accType = checkAccType(txn.getAccountNo());
                        CommunicatorRepository commR = new CommunicatorRepository();
                        totComm = (Double.parseDouble(txn.getCommissionAmount()) + Double.parseDouble(txn.getCeilingOrFloorCommission()));
                        String totalComm = String.valueOf(totComm);
                        s = commR.executeFCITransaction(txn.getAccountNo(), accType, toAccount, toAcctType, txn.getCamount1(), totalComm, txn.getRemarks(), txn.getReferenceNo());
                        List<String> sList = Arrays.asList(s);
                        if (sList.get(0).equalsIgnoreCase("0")) {
                            jSONObject.put("errorStatus", false);
                            jSONObject.put("bankReference", txn.getReferenceNo());
                            jSONObject.put("errorMessage", "");
                            resp = withinTill(query, txn.getReferenceNo(), txn.getTransactionType(), txn.getUserTill(), txn.getIcurrencyselector1(), txn.getIcurrencyselector2(), txn.getIcurrencyselector3(), txn.getIcurrencyselector4(), txn.getTamount1(), txn.getTamount2(), txn.getTamount3(), txn.getTamount4(), txn.getTotalToCustomer(), txn.getUser(), txn.getIpAddress(), txn.getHostname());
                            if (!resp) {
                                jSONObject.put("errorStatus", true);
                                jSONObject.put("bankReference", "ERROR");
                                jSONObject.put("errorMessage", "Error in Save Till communicator Data.");
                            }
                        } else {
                            jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", sList.get(1));
                        }
                    } else if (txn.getTransactionType().equalsIgnoreCase("PFC")) {
                        accType = checkAccType(txn.getAccountNo());
                        CommunicatorRepository commR = new CommunicatorRepository();
                        s = commR.executePFCTransaction(txn.getAccountNo(), accType, toAccount, toAcctType, txn.getTamount1(), txn.getIcurrencyselector1(), txn.getRemarks(), txn.getReferenceNo());
                        List<String> sList = Arrays.asList(s);
                        if (sList.get(0).equalsIgnoreCase("0")) {
                            jSONObject.put("errorStatus", false);
                            jSONObject.put("bankReference", txn.getReferenceNo());
                            jSONObject.put("errorMessage", "");
                            resp = withinTill(query, txn.getReferenceNo(), txn.getTransactionType(), txn.getUserTill(), txn.getIcurrencyselector1(), txn.getIcurrencyselector2(), txn.getIcurrencyselector3(), txn.getIcurrencyselector4(), txn.getTamount1(), txn.getTamount2(), txn.getTamount3(), txn.getTamount4(), txn.getTotalToCustomer(), txn.getUser(), txn.getIpAddress(), txn.getHostname());
                            if (!resp) {
                                jSONObject.put("errorStatus", true);
                                jSONObject.put("bankReference", "ERROR");
                                jSONObject.put("errorMessage", "Error in Save Till communicator Data.");
                            }
                        } else {
                            jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", sList.get(1));
                        }

                    }
                    else {
                        resp = withinTill(query, txn.getReferenceNo(), txn.getTransactionType(), txn.getUserTill(), txn.getIcurrencyselector1(), txn.getIcurrencyselector2(), txn.getIcurrencyselector3(), txn.getIcurrencyselector4(), txn.getTamount1(), txn.getTamount2(), txn.getTamount3(), txn.getTamount4(), txn.getTotalToCustomer(), txn.getUser(), txn.getIpAddress(), txn.getHostname());
                        if (!resp) {
                            jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", "Error in Save txn Data.");
                        }
                        else {
                            jSONObject.put("errorStatus", false);
                            jSONObject.put("bankReference", txn.getReferenceNo());
                            jSONObject.put("errorMessage", "Sucessfully Save txn Data.");
                        } 
                    }

                } catch (Exception e) {
                    logger.error(e);
                    query = "Update "+txnLibrary+".PYP00301 set TRSTATUS='D' where TRREFNUM = '"+txn.getReferenceNo()+"'";
                    try {
                       resp = insertTableData.insertTableData(query);
                            jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", "Error in update teller till balances");
                    } catch (Exception ex) {
                       logger.error("Error in update transaction status as deleted: ", ex);
                            jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", "Error in update transaction status as deleted");
                    }
                }
             }//end of respQuery true
             else{
             jSONObject.put("errorStatus", true);
                            jSONObject.put("bankReference", "ERROR");
                            jSONObject.put("errorMessage", "Transaction not saved");
             }
//             
            }//end of if else
            else {
                jSONObject.put("errorStatus", true);
                jSONObject.put("bankReference", "ERROR");
                jSONObject.put("errorMessage", "Insufficient balance to perform the transaction.");
            }
        } catch (Exception e) { //Initial Catch
            logger.error("Error in checking Till Amount", e);
        }
        logger.debug("08_INSERTDATA_REPO_SUCCESS" + getCurrentTimeStamp());
        return jSONObject.toString();
    }


    public String checkAccType(String accNo) {
        String accType = null;
        String accCategory = null;
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;

        try {
            String query = "select DMTYP as accType  "
                    + "from " + dataLibrary + ".TAP00201 "
                    + "where DMACCT = '" + accNo + "' ";

            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                accType = rs.getString("accType");
            }
        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
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
        if (accType.equalsIgnoreCase("1")) {
            accCategory = "SV";
        } else if (accType.equalsIgnoreCase("6")) {
            accCategory = "DD";
        }
        return accCategory;
    }

    private boolean checkTillAmount(String sourceTill, String curr1, String curr2, String curr3, String curr4, String currAmount1, String currAmount2, String currAmount3, String currAmount4, String txnType, String lkrAmount) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        Double currBalance = 0.0;
        boolean resp = false;
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        List<CurrencyAmounts> currAmountObj = new ArrayList<>();

        try {

            CurrencyAmounts caItem1 = new CurrencyAmounts();
            CurrencyAmounts caItem2 = new CurrencyAmounts();
            CurrencyAmounts caItem3 = new CurrencyAmounts();
            CurrencyAmounts caItem4 = new CurrencyAmounts();

            caItem1.setCurr(curr1);
            caItem1.setCurrAmount(Double.parseDouble(currAmount1));
            currAmountObj.add(caItem1);

            caItem2.setCurr(curr2);
            caItem2.setCurrAmount(Double.parseDouble(currAmount2));
            currAmountObj.add(caItem2);

            caItem3.setCurr(curr3);
            caItem3.setCurrAmount(Double.parseDouble(currAmount3));
            currAmountObj.add(caItem3);

            caItem4.setCurr(curr4);
            caItem4.setCurrAmount(Double.parseDouble(currAmount4));
            currAmountObj.add(caItem4);

            for (int i = 0; i < currAmountObj.size(); i++) {
                if (currAmountObj.get(i).getCurr().equalsIgnoreCase("0")) {
                    currAmountObj.remove(i);
                }

            }

            if (txnType.equalsIgnoreCase("FCP")) {
                try {
                    String query = "select TPCURBAL as currBlnc "
                            + "from " + txnLibrary + ".PYT00601 "
                            + "where TPTILID = '" + sourceTill + "' and TPCURID = 'LKR' ";
                    try {
                        con = DbConnection.getConnection();
                    } catch (SQLException e) {
                        logger.error("Error in create connection : ", e);
                    }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query);
                    while (rs.next()) {
                        currBalance = rs.getDouble("currBlnc");
                    }
                    if (currBalance >= (Double.parseDouble(lkrAmount))) {
                        resp = true;
                    }
                } catch (Exception e) {
                    logger.error("Error in talli curr Balance", e);
                }
            } else if (txnType.equalsIgnoreCase("FCS") || txnType.equalsIgnoreCase("FCR") || txnType.equalsIgnoreCase("FCI") || txnType.equalsIgnoreCase("PFC")) {
                try {
                    for (int i = 0; i < currAmountObj.size(); i++) {

                        String query = "select TPCURBAL as currBlnc "
                                + "from " + txnLibrary + ".PYT00601 "
                                + "where TPTILID = '" + sourceTill + "' and TPCURID = '" + currAmountObj.get(i).getCurr() + "' ";
                        try {
                            con = DbConnection.getConnection();
                        } catch (SQLException e) {
                            logger.error("Error in create connection : ", e);
                        }
                        stmnt = con.createStatement();
                        rs = stmnt.executeQuery(query);
                        while (rs.next()) {
                            currBalance = rs.getDouble("currBlnc");
                        }
                        if (currBalance >= currAmountObj.get(i).getCurrAmount()) {
                            resp = true;
                        } else {
                            break;
                        }
                    }//end of for loop
                } catch (Exception e) {
                    logger.error("Error in talli curr Balance", e);
                }

            }

            /////////////
            //////////////////
        } catch (Exception e) {
            logger.error("Error in checkTillAmount : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in close result set", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in close statement", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in close connesction", ex);
            }
        }
        return resp;
    }

    public boolean withinTill(String sql, String referenceNo, String txnType, String till, String curr1, String curr2, String curr3, String curr4, String currAmount1, String currAmount2, String currAmount3, String currAmount4, String lkrAmount, String user, String ip, String host) {
        String response = null;
        String curr = null;
        String currAmount = null;
        boolean resp = false;
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String query = null;
        JSONObject jSONObject = new JSONObject();
        Statement stmt = null;
        int[] result = null;
        Connection con = null;
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
        try {
            try {
                con = DbConnection.getConnection();
                stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                        ResultSet.CONCUR_UPDATABLE);
                stmt = con.createStatement();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
//            stmt.addBatch(sql);
            switch (txnType) {
                case "FCP":
                    try {
                        for (int i = 0; i < 4; i++) {
                            if (i == 0) {
                                curr = curr1;
                                currAmount = currAmount1;
                            } else if (i == 1) {
                                curr = curr2;
                                currAmount = currAmount2;
                            } else if (i == 2) {
                                curr = curr3;
                                currAmount = currAmount3;
                            } else {
                                curr = curr4;
                                currAmount = currAmount4;
                            }
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + currAmount + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr + "' ";
                            stmt.addBatch(query);

///
                            query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                    + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                    + " TCCRTTIM ) "
                                    + " values ('"
                                    + referenceNo + "', '"
                                    + till + "', '"
                                    + till + "', '"
                                    + curr + "','"
                                    + currAmount + "', '"
                                    + user + "', '"
                                    + ip + "', '"
                                    + host + "', '"
                                    + timeStamp + "' )";
                            stmt.addBatch(query);
                        }
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                        stmt.addBatch(query);

                        query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + referenceNo + "', '"
                                + till + "', '"
                                + till + "', "
                                + " 'LKR','"
                                + lkrAmount + "', '"
                                + user + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query);
/////
                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCS":
                    try {
                        for (int i = 0; i < 4; i++) {
                            if (i == 0) {
                                curr = curr1;
                                currAmount = currAmount1;
                            } else if (i == 1) {
                                curr = curr2;
                                currAmount = currAmount2;
                            } else if (i == 2) {
                                curr = curr3;
                                currAmount = currAmount3;
                            } else {
                                curr = curr4;
                                currAmount = currAmount4;
                            }
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr + "' ";
                            stmt.addBatch(query);

///
                            query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                    + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                    + " TCCRTTIM ) "
                                    + " values ('"
                                    + referenceNo + "', '"
                                    + till + "', '"
                                    + till + "', '"
                                    + curr + "','"
                                    + currAmount + "', '"
                                    + user + "', '"
                                    + ip + "', '"
                                    + host + "', '"
                                    + timeStamp + "' )";
                            stmt.addBatch(query);
                        }

                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                        stmt.addBatch(query);
                        query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + referenceNo + "', '"
                                + till + "', '"
                                + till + "', "
                                + " 'LKR','"
                                + lkrAmount + "', '"
                                + user + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query);
                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCR":
                    try {
                        for (int i = 0; i < 4; i++) {
                            if (i == 0) {
                                curr = curr1;
                                currAmount = currAmount1;
                            } else if (i == 1) {
                                curr = curr2;
                                currAmount = currAmount2;
                            } else if (i == 2) {
                                curr = curr3;
                                currAmount = currAmount3;
                            } else {
                                curr = curr4;
                                currAmount = currAmount4;
                            }
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr + "' ";
                            stmt.addBatch(query);

///
                            query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                    + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                    + " TCCRTTIM ) "
                                    + " values ('"
                                    + referenceNo + "', '"
                                    + till + "', '"
                                    + till + "', '"
                                    + curr + "','"
                                    + currAmount + "', '"
                                    + user + "', '"
                                    + ip + "', '"
                                    + host + "', '"
                                    + timeStamp + "' )";
                            stmt.addBatch(query);
                        }

                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                        stmt.addBatch(query);
                        query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                + " TCCRTTIM ) "
                                + " values ('"
                                + referenceNo + "', '"
                                + till + "', '"
                                + till + "', "
                                + " 'LKR','"
                                + lkrAmount + "', '"
                                + user + "', '"
                                + ip + "', '"
                                + host + "', '"
                                + timeStamp + "' )";
                        stmt.addBatch(query);
                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCI":
                    try {
                        for (int i = 0; i < 4; i++) {
                            if (i == 0) {
                                curr = curr1;
                                currAmount = currAmount1;
                            } else if (i == 1) {
                                curr = curr2;
                                currAmount = currAmount2;
                            } else if (i == 2) {
                                curr = curr3;
                                currAmount = currAmount3;
                            } else {
                                curr = curr4;
                                currAmount = currAmount4;
                            }
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr + "' ";
                            stmt.addBatch(query);

///
                            query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                    + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                    + " TCCRTTIM ) "
                                    + " values ('"
                                    + referenceNo + "', '"
                                    + till + "', '"
                                    + till + "', '"
                                    + curr + "','"
                                    + currAmount + "', '"
                                    + user + "', '"
                                    + ip + "', '"
                                    + host + "', '"
                                    + timeStamp + "' )";
                            stmt.addBatch(query);
                        }
                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "PFC":
                    try {
                        for (int i = 0; i < 4; i++) {
                            if (i == 0) {
                                curr = curr1;
                                currAmount = currAmount1;
                            } else if (i == 1) {
                                curr = curr2;
                                currAmount = currAmount2;
                            } else if (i == 2) {
                                curr = curr3;
                                currAmount = currAmount3;
                            } else {
                                curr = curr4;
                                currAmount = currAmount4;
                            }
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr + "' ";
                            stmt.addBatch(query);

///
                            query = "INSERT INTO " + txnLibrary + ".PYP00501 "
                                    + "(TCREFNUM, TCSRCTIL, TCDESTIL, TCCURID, TCTRAMNT, TCCRTUSR, TCCRTIP, TCCRTHOST,"
                                    + " TCCRTTIM ) "
                                    + " values ('"
                                    + referenceNo + "', '"
                                    + till + "', '"
                                    + till + "', '"
                                    + curr + "','"
                                    + currAmount + "', '"
                                    + user + "', '"
                                    + ip + "', '"
                                    + host + "', '"
                                    + timeStamp + "' )";
                            stmt.addBatch(query);
                        }
                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
            }
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

        } catch (Exception e) {
            logger.error("Error in calculate commission : ", e);
        }
        return resp;
    }

    public String getMaxReferenceSequence(String date) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        String number = "";
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        int serialNum = 0;
        int serial = 0;
        try {
            String query = "select max(EFSEQNUM) as EFSEQNUM "
                    + "from " + txnLibrary + ".IEP00301 "
                    + "where EFDATE = " + date + "";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                serial = rs.getInt("EFSEQNUM");
            }
            if (serial == 0) {
                number = "00001";
            } else {
                serialNum = serial + 1;
                String stNum = Integer.toString(serialNum);
                number = ("00000" + stNum).substring(stNum.length());
            }
        } catch (Exception e) {
            logger.error("Error in getMaxNum : ", e);
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
        return number;
    }

    public String getTransactions(String txnType, String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String whereClause = generateTxnListWhereClause(txnType, tillID);
        try {
            String query = "select      TRIM(txn.TRREFNUM) as REFNO, "
                    + "txn.TRUINCOD as UINTYPE, "
                    + "txn.TRTXNTYP as TXNTYPE, "
                    + "TRIM(txn.TRUINNUM) as UINNUMBER, "
                    + "TRIM(txn.TRACCNUM) as ACCNUMBER, "
                    + "TRIM(txn.TRCURR1) as CURR1, "
                    + "TRIM(txn.TRCURR2) as CURR2, "
                    + "TRIM(txn.TRCURR3) as CURR3, "
                    + "TRIM(txn.TRCURR4) as CURR4, "
                    + "txn.TRAMT1 as AMOUNT1, "
                    + "txn.TRAMT2 as AMOUNT2, "
                    + "txn.TRAMT3 as AMOUNT3, "
                    + "txn.TRAMT4 as AMOUNT4, "
                    + "txn.TRINCAMT as INCENTIVE, "
                    + "txn.TRCOMAMT as COMMISION, "
                    + "txn.TRLKRTOT as LKRTOTAL, "
                    + "txn.TRISFXCV as crossconversionFlag, "
                    + "TRIM(txn.TRNAME) as NAME, "
                    + "txn.TRNATXCD as NATTXNCODE, "
                    + "txn.TRITRSCD as ITRSCODE, "
                    + "txn.TRACTYCD as ACCTYPECODE, "
                    + "txn.TRSTATUS as STATUS, "
                    + "txn.TRCMNSTA as COMMSTATUS, "
                    + "txn.TRAUTSTA as AUTSTATUS, "
                    + "txn.TRTXSECD as SECCODE "
                    + " from " + txnLibrary + ".PYP00301 txn "
                    + whereClause + " order by TRTIMEST ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Transactions from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Transactions : ", e);
        }

        return response;
    }

    private String generateTxnListWhereClause(String txnType, String tillID) {
        String whereClause = "";
        switch (txnType) {
            case "till":
                if (tillID.equals("1")){
                    whereClause = "WHERE TREFDATE =" + getManDateFormatted();
                } else {
                    whereClause = "WHERE TREFDATE =" + getManDateFormatted() + " and TRUSRTIL = '" + tillID + "' ";
                }
                break;
            case "cancel":
                whereClause = "WHERE TREFDATE =" + getManDateFormatted() + " and TRUSRTIL = '" + tillID + "' and TRSTATUS = ' ' and TRTXNTYP not in ( 'FCI', 'PFC') ";
                break;
            case "pendingcancel":
                whereClause = "WHERE TREFDATE =" + getManDateFormatted() + " and  TRSTATUS = 'X' ";
                break;
        }
        return whereClause;
    }
    public String getTransactionExceptions(String tillID) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String whereClause = generateExceptionTxnListWhereClause(tillID);
        try {
            String query = "select      TRIM(txn.TRREFNUM) as REFNO, "
                    + "txn.TRUINCOD as UINTYPE, "
                    + "txn.TRTXNTYP as TXNTYPE, "
                    + "TRIM(txn.TRUINNUM) as UINNUMBER, "
                    + "TRIM(txn.TRACCNUM) as ACCNUMBER, "
                    + "TRIM(txn.TRCURR1) as CURR1, "
                    + "TRIM(txn.TRCURR2) as CURR2, "
                    + "TRIM(txn.TRCURR3) as CURR3, "
                    + "TRIM(txn.TRCURR4) as CURR4, "
                    + "txn.TRAMT1 as AMOUNT1, "
                    + "txn.TRAMT2 as AMOUNT2, "
                    + "txn.TRAMT3 as AMOUNT3, "
                    + "txn.TRAMT4 as AMOUNT4, "
                    + "txn.TRINCAMT as INCENTIVE, "
                    + "txn.TRCOMAMT as COMMISION, "
                    + "txn.TRLKRTOT as LKRTOTAL, "
                    + "txn.TRISFXCV as crossconversionFlag, "
                    + "TRIM(txn.TRNAME) as NAME, "
                    + "txn.TRNATXCD as NATTXNCODE, "
                    + "txn.TRITRSCD as ITRSCODE, "
                    + "txn.TRACTYCD as ACCTYPECODE, "
                    + "txn.TRCMNSTA as STATUS, "
                    + "txn.TRTXSECD as SECCODE "
                    + " from " + txnLibrary + ".PYP00301 txn "
                    + whereClause + " order by TRTIMEST ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Transactions from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Transactions : ", e);
        }

        return response;
    }

    private String generateExceptionTxnListWhereClause(String tillID) {
        String whereClause = "";
        if (tillID.equals("1")) {
           whereClause = "WHERE TREFDATE =" + getManDateFormatted() + " and TRSTATUS != 'C' and TRCMNSTA ='N' "; 
        } else {
            whereClause = "WHERE TREFDATE =" + getManDateFormatted() + " and TRUSRTIL = '" + tillID + "' and TRSTATUS != 'C' and TRCMNSTA ='N' ";
        }
        
        return whereClause;
    }
    public String getBRefNumber(String bref) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        boolean isValidRef = false;
        boolean errorStatus = true;
        JSONObject resultJson = new JSONObject();
        try {
            String query = "select FSREF as BREFNO "
                    + "from " + dataLibrary + ".FSP00201 "
                    + "where FSREF ='" + bref + "'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                isValidRef = true;
                errorStatus = false;
            }
            resultJson.put("errorStatus", errorStatus);
            resultJson.put("isValidRef", isValidRef);
        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
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
        return resultJson.toString();
    }

    public String getExchangeReceiptNumber(String receiptNumber) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        boolean isValidRef = false;
        boolean errorStatus = true;
        String timestamp = "";
        String totaltocustomer = "";
        String currency1 = "";
        String currency2 = "";
        String currency3 = "";
        String currency4 = "";
        String amount1 = "";
        String amount2 = "";
        String amount3 = "";
        String amount4 = "";

        JSONObject resultJson = new JSONObject();
        try {
            String query = "select TRREFNUM as REFNO, "
                    + "TRCURR1 as CURR1, TRCURR2 as CURR2, TRCURR3 as CURR3, TRCURR4 as CURR4, "
                    + "TRAMT1 as AMOUNT1, TRAMT2 as AMOUNT2, TRAMT3 as AMOUNT3, TRAMT4 as AMOUNT4, "
                    + "TRTIMEST as TIMESTAMP, TRCUSTOT as TOTALTOCUSTOMER "
                    + "from " + txnLibrary + ".PYP00301 "
                    + "where TRREFNUM ='" + receiptNumber + "' and  TRSTATUS = ' ' and TRTXNTYP='FCP' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                isValidRef = true;
                errorStatus = false;
                timestamp = rs.getString("TIMESTAMP");
                totaltocustomer = rs.getString("TOTALTOCUSTOMER");
                currency1 = rs.getString("CURR1");
                currency2 = rs.getString("CURR2");
                currency3 = rs.getString("CURR3");
                currency4 = rs.getString("CURR4");
                amount1 = rs.getString("AMOUNT1");
                amount2 = rs.getString("AMOUNT2");
                amount3 = rs.getString("AMOUNT3");
                amount4 = rs.getString("AMOUNT4");

            }
            resultJson.put("errorStatus", errorStatus);
            resultJson.put("isValidRef", isValidRef);
            resultJson.put("errorStatus", errorStatus);
            resultJson.put("isValidRef", isValidRef);
            resultJson.put("timestamp", timestamp);
            resultJson.put("totaltocustomer", totaltocustomer);
            resultJson.put("curr1", currency1);
            resultJson.put("curr2", currency2);
            resultJson.put("curr3", currency3);
            resultJson.put("curr4", currency4);
            resultJson.put("amount1", amount1);
            resultJson.put("amount2", amount2);
            resultJson.put("amount3", amount3);
            resultJson.put("amount4", amount4);

        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
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
        return resultJson.toString();
    }

    public String getITRSCodesDataForAccounts(String acctype, String prodcode, String natureoftxn) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select TRIM(t.ITRSCODE) as code, "
                    + "SUBSTRING(t.ITRSCDESC, 1, 60) as name "
                    + "from " + dataLibrary + ".ITRSCOD001 t, "
                    + "" + dataLibrary + ".IEP00401 p "
                    + "where "
                    + "p.ITNATTXN ='" + natureoftxn + "' and "
                    + "ITPRCODE ='" + prodcode + "' and "
                    + "ITACTYPE = '" + acctype + "' and "
                    + "p.ITRSCODE = t.ITRSCID ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Transaction Sector codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Transaction Sector codes data : ", e);
        }
        return response;
    }

    public String getTransactionData(String txnRefNo) {
        ITRSInternationalTxn txnView = getInternationalTxnView(txnRefNo);
        JSONObject jsonObject = new JSONObject(txnView);
        return jsonObject.toString();
    }

    public ITRSInternationalTxn getInternationalTxnView(String txnRefNo) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        ITRSInternationalTxn txnView = new ITRSInternationalTxn();
        try {
            String query = "select     t.TRREFNUM as txnRefNo, "
                    //                    + "t.EFF12REF as form12RefNo, "
                    + "t.TRBRNCOD as branchCode, "
                    + "t.TRUINCOD as uinCode, "
                    + "t.TRUINNUM as uinNumber, "
                    + "t.TRACCNUM as accountNumber, "
                    + "t.TRTXNTYP as txnType, "
                    + "t.TRNAME as customerName, "
                    + "t.TRADDRES as addressLine, "
                    //                    + "t.EFADDRL2 as addressLine2, "
                    //                    + "t.EFADDRL3 as addressLine3, "
                    + "t.TRPASSPO as passport, "
                    + "t.TRAIRTKT as aitTicketNo, "
                    + "t.TRNATXCD as natureofTxn, "
                    + "t.TRACTYCD as acctypecode, "
                    + "t.TRTXSECD as sectorcode, "
                    + "t.TRITRSCD as itrscode, "
                    + "t.TRISFXCV as crossconversionFlag, "
                    + "t.TRCOUNTR as majorCountry, "
                    + "TRIM(t.TRCURR1) as currency1, "
                    + "t.TRAMT1 as amount1, "
                    + "t.TREXRAT1 as rate1, "
                    + "t.TRCVAMT1 as convertedamount1, "
                    + "TRIM(t.TRCURR2) as currency2, "
                    + "t.TRAMT2 as amount2, "
                    + "t.TREXRAT2 as rate2, "
                    + "t.TRCVAMT2 as convertedamount2, "
                    + "TRIM(t.TRCURR3) as currency3, "
                    + "t.TRAMT3 as amount3, "
                    + "t.TREXRAT3 as rate3, "
                    + "t.TRCVAMT3 as convertedamount3, "
                    + "TRIM(t.TRCURR4) as currency4, "
                    + "t.TRAMT4 as amount4, "
                    + "t.TREXRAT4 as rate4, "
                    + "t.TRCVAMT4 as convertedamount4, "
                    + "t.TRBENAME as benename, "
                    + "t.TRBECNTR as benecountry, "
                    + "t.TRBERMBK as benebank, "
                    + "t.TRCOMPER as commision_percentage, "
                    + "t.TRCOMAMT as commision_total, "
                    + "t.TRCOMFCA as commision_ceilingfloor, "
                    + "t.TRINCAMT as incentive_total, "
                    + "t.TRCUSTOT as customer_total, "
                    + "t.TRLKRTOT as lkr_total, "
                    + "t.TRRECAMT as received_amount, "
                    + "t.TRREFAMT as refunded_amount, "
                    + "t.TRCRTUSR as createdUser, "
                    + "t.TRCANUSR as cancelledUser, "
                    + "t.TRTIMEST as createdTimeStamp, "
                    + "t.TRCANTIM as cancelledTimeStamp, "
                    + "t.TRAUTUSR as authUser, "
                    + "t.TRAUTTIM as authTimeStamp, "
                    + "t.TRAUTRES as authReason, "
                    + "t.TRIPADDR as createdIpAddress, "
                    + "t.TRHOSTNM as createdhost, "
                    + "t.TRSTATUS as status, "
                    + "t.TRREMARK as remarks, "
                    + "t.TRCANRES as reason "
                    + "from        " + txnLibrary + ".PYP00301 t  "
                    + "where       t.TRREFNUM = '" + txnRefNo + "' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                txnView.setReferenceNo(txnRefNo);
//                txnView.setForm12No(rs.getString("form12RefNo"));
                txnView.setBranchCode(rs.getString("branchCode"));
                txnView.setUincode(rs.getString("uinCode"));
                txnView.setUinnumber(rs.getString("uinNumber"));
                txnView.setAccountNo(rs.getString("accountNumber"));
                txnView.setTransactionType(rs.getString("txnType"));
                txnView.setCusname(rs.getString("customerName"));
                txnView.setCustaddr1(rs.getString("addressLine"));
                txnView.setAirTicketNo(rs.getString("aitTicketNo"));
//                txnView.setCustaddr3(rs.getString("addressLine3"));
                txnView.setPassportNo(rs.getString("passport"));
                txnView.setNatureOfTxnCode(rs.getString("natureofTxn"));
                txnView.setAccounttypecode(rs.getString("acctypecode"));
                txnView.setSectorcode(rs.getString("sectorcode"));
                txnView.setItrscode(rs.getString("itrscode"));
                txnView.setMajorcountry(rs.getString("majorCountry"));
                txnView.setIcurrencyselector1(rs.getString("currency1"));
                txnView.setTamount1(rs.getString("amount1"));
                txnView.setRate1(rs.getString("rate1"));
                txnView.setCamount1(rs.getString("convertedamount1"));
                txnView.setIcurrencyselector2(rs.getString("currency2"));
                txnView.setTamount2(rs.getString("amount2"));
                txnView.setRate2(rs.getString("rate2"));
                txnView.setCamount2(rs.getString("convertedamount2"));
                txnView.setIcurrencyselector3(rs.getString("currency3"));
                txnView.setTamount3(rs.getString("amount3"));
                txnView.setRate3(rs.getString("rate3"));
                txnView.setCamount3(rs.getString("convertedamount3"));
                txnView.setIcurrencyselector4(rs.getString("currency4"));
                txnView.setTamount4(rs.getString("amount4"));
                txnView.setRate4(rs.getString("rate4"));
                txnView.setCamount4(rs.getString("convertedamount4"));
                txnView.setBenename(rs.getString("benename"));
                txnView.setBenecountry(rs.getString("benecountry"));
                txnView.setBenebank(rs.getString("benebank"));
                txnView.setUser(rs.getString("createdUser"));
                txnView.setCancelleduser(rs.getString("cancelledUser"));
                txnView.setTimestamp(rs.getString("createdTimeStamp"));
                txnView.setCancelledtimestamp(rs.getString("cancelledTimeStamp"));
                txnView.setIpAddress(rs.getString("createdIpAddress"));
                txnView.setHostname(rs.getString("createdhost"));
                txnView.setTotalIncentive(rs.getString("incentive_total"));
                txnView.setTotalToCustomer(rs.getString("customer_total"));
                txnView.setTotalLKR(rs.getString("lkr_total"));
                txnView.setCeilingOrFloorCommission(rs.getString("commision_ceilingfloor"));
                txnView.setCommissionPercentage(rs.getString("commision_percentage"));
                txnView.setCommissionAmount(rs.getString("commision_total"));
                txnView.setReceivedAmount(rs.getString("received_amount"));
                txnView.setRefundAmount(rs.getString("refunded_amount"));
                txnView.setReason(rs.getString("reason"));
                txnView.setStatus(rs.getString("status"));
                txnView.setAuthuser(rs.getString("authUser"));
                txnView.setAuthtimestamp(rs.getString("authTimestamp"));
                txnView.setAuthreason(rs.getString("authReason"));
                txnView.setRemarks(rs.getString("remarks"));
            }
        } catch (Exception ex) {
            logger.error("ERROR in Insert Basic Data : ", ex);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in colse result set", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in colse statement", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colse connesction", ex);
            }
        }
        return txnView;
    }

    private String getCurrentTimeStamp() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }

    private String getCurrentDate() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy/MM/dd");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }

    private String getCurrentDateNumeric() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyyMMdd");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }

    public String calculateCommission(String txnType, String passHolType, String amount) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = null;
        Double dAmount = 0.0;
        Double commission = 0.0;
        String query = null;
        JSONObject jSONObject = new JSONObject();

        try {
            dAmount = Double.parseDouble(amount);
            switch (txnType) {
                case "FCS":
                    
                    query = "select TFMAXVAL,TFCOMPER, TFCOMVAL from " + txnLibrary + ".PYP01201 where TFTXNTYP = 'FCS' and TFPASTYP = '" + passHolType + "' and TFSTATUS = 'A' ";
                    response = commissionCalc(query, txnType, dAmount);
                    break;
                case "FCP":
                    commission = 0.0;
                    break;
                case "FCR":
                    query = "select TFMAXVAL,TFCOMPER, TFCOMVAL from " + txnLibrary + ".PYP01201 where TFTXNTYP = 'FCR' and TFSTATUS = 'A' ";
                    response = commissionCalc(query, txnType, dAmount);
                    break;
                case "FCI":
                    query = "select TFMAXVAL,TFCOMPER, TFCOMVAL from " + txnLibrary + ".PYP01201 where TFTXNTYP = 'FCI' and TFPASTYP = '" + passHolType + "' and TFSTATUS = 'A' ";
                    response = commissionCalc(query, txnType, dAmount);
                    break;
            }
            //response = commission.toString();
        } catch (Exception e) {
            logger.error("Error in calculate commission : ", e);
        }
        return response;
    }

    private String commissionCalc(String query, String txnType, Double dAmount) throws JSONException {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        Double commission = 0.0;
        Double prcntge = 0.0;
        CommissionRates cRates = new CommissionRates();
        List<CommissionRates> commissionRates = new ArrayList<>();
        JSONObject jSONObject = new JSONObject();
        try {
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(query);
                while (rs.next()) {
                    
//                    cRates.setMinVal(rs.getDouble("TFMINVAL"));
                    cRates.setMaxVal(rs.getDouble("TFMAXVAL"));
                    cRates.setComPerctge(rs.getDouble("TFCOMPER"));
                    cRates.setComValue(rs.getDouble("TFCOMVAL"));
//                    cRates.setComming(rs.getDouble("TFCOMMIN"));
                    commissionRates.add(cRates);
                }
            } catch (SQLException Ex) {
                logger.error("Error get commission Rates data : ", Ex);
            }

        } catch (Exception e) {
            logger.error("Error get commission Rates data : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error get commission Rates data", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error get commission Rates data", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error get commission Rates data", ex);
            }

        }
        try {
            if (txnType.equalsIgnoreCase("FCS") || txnType.equalsIgnoreCase("FCI")) {
                 if (dAmount > cRates.getMaxVal()){
                   commission = dAmount * cRates.getComPerctge() / 100;
                   prcntge = cRates.getComPerctge();
                 } else {
                   commission = cRates.getComValue();
                
                 }
                
                
                
// -------------------- Modified on 16/02/2023 after changing the tariff file-------------- 

//                for (int i = 0; i <= commissionRates.size(); i++) {
//                    if ((dAmount >= commissionRates.get(i).getMinVal()) && (dAmount <= commissionRates.get(i).getMaxVal())) {
//                        if (commissionRates.get(i).getComPerctge() > 0) {
//                            commission = dAmount * commissionRates.get(i).getComPerctge() / 100;
//                            prcntge = commissionRates.get(i).getComPerctge();
//                        } else {
//                            
//                            commission = commissionRates.get(i).getComValue();
//                        }
//                    }
//                }
//-----------------------------------------------------------------------------------------------
            } else if (txnType.equalsIgnoreCase("FCR")) {
                commission = dAmount * cRates.getComPerctge() / 100;
                if (commission > cRates.getComValue()) {
                    commission = commission;
                    prcntge = cRates.getComPerctge();
                } else if (commission <= cRates.getComValue()) {
                    commission = cRates.getComValue();
                }
            }
        } catch (Exception e) {
            logger.error("Error in get commission  calculation : ", e);
        }
        //return commission;
        jSONObject.put("commission", commission);
        jSONObject.put("percentage", prcntge);
        return jSONObject.toString();
    }

    public JSONObject retriveTxnData(String txnRef) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = null;
        Double dAmount = 0.0;
        Double commission = 0.0;
        JSONObject jSONObject = new JSONObject();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String txnType = null;
        String curr4 = null;
        String curr1 = null;
        String curr2 = null;
        String curr3 = null;
        String tillId = null;
        String lkrAmount = null;
        String currAmount4 = null;
        String currAmount1 = null;
        String currAmount2 = null;
        String currAmount3 = null;
        JSONObject resultJson = new JSONObject();

        try {
            String query = "select TRUSRTIL as tillID, TRTXNTYP as txnType, TRCUSTOT as lkrAmount, "
                    + "TRCURR1 as curr1, TRCURR2 as curr2, TRCURR3 as curr3,  "
                    + "TRCURR4 as curr4, TRAMT1 as currAmount1 , TRAMT2 as currAmount2, "
                    + "TRAMT3 as currAmount3, TRAMT4 as currAmount4 "
                    + "from " + txnLibrary + ".PYP00301 "
                    + "where TRREFNUM ='" + txnRef + "'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                txnType = rs.getString("txnType");
                tillId = rs.getString("tillId");
                lkrAmount = rs.getString("lkrAmount");

                curr1 = rs.getString("curr1");
                curr2 = rs.getString("curr2");
                curr3 = rs.getString("curr3");
                curr4 = rs.getString("curr4");

                currAmount1 = rs.getString("currAmount1");
                currAmount2 = rs.getString("currAmount2");
                currAmount3 = rs.getString("currAmount3");
                currAmount4 = rs.getString("currAmount4");
            }
            resultJson.put("txnType", txnType);
            resultJson.put("tillId", tillId);
            resultJson.put("lkrAmount", lkrAmount);
            resultJson.put("curr1", curr1);
            resultJson.put("curr2", curr2);
            resultJson.put("curr3", curr3);
            resultJson.put("curr4", curr4);

            resultJson.put("currAmount1", currAmount1);
            resultJson.put("currAmount2", currAmount2);
            resultJson.put("currAmount3", currAmount3);
            resultJson.put("currAmount4", currAmount4);
            //response = commission.toString();
        } catch (Exception e) {
            logger.error("Error in calculate commission : ", e);
        }
        return resultJson;
    }

    public String approveCancelTransaction(String txnRef, String user, String reason, String ip, String hostname) throws ClassNotFoundException, SQLException, JSONException {
        String resp = "";
        boolean cancelresp = false;

        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        VaultRepository vr = new VaultRepository();
        Statement stmt = null;
        int[] result = null;
        Connection con = null;
        String curr = null;
        String currAmount = null;
        JSONObject jSonObj = new JSONObject();
        jSonObj = retriveTxnData(txnRef);
        int count = 0;
        String query ="";
       
        try {
            String txnType = jSonObj.getString("txnType");

            String curr1 = jSonObj.getString("curr1");
            String curr2 = jSonObj.getString("curr2");
            String curr3 = jSonObj.getString("curr3");
            String curr4 = jSonObj.getString("curr4");

            String lkrAmount = jSonObj.getString("lkrAmount");
            String till = jSonObj.getString("tillId");

            String currAmount1 = jSonObj.getString("currAmount1");
            String currAmount2 = jSonObj.getString("currAmount2");
            String currAmount3 = jSonObj.getString("currAmount3");
            String currAmount4 = jSonObj.getString("currAmount4");


                try {
                    con = DbConnection.getConnection();
                    stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                            ResultSet.CONCUR_UPDATABLE);
                    stmt = con.createStatement();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                


                switch (txnType) {
                    case "FCP":
                        try {

                            for (int i = 0; i < 4; i++) {
                                if (i == 0) {
                                    curr = curr1;
                                    currAmount = currAmount1;

                                } else if (i == 1) {
                                    curr = curr2;
                                    currAmount = currAmount2;

                                } else if (i == 2) {
                                    curr = curr3;
                                    currAmount = currAmount3;

                                } else {
                                    curr = curr4;
                                    currAmount = currAmount4;

                                }
                                
                                if (vr.checkTillValue(till, currAmount, curr) == true) {
                                     count++;
                                     break;
                                }
                                
                            }
                            
                            if (count > 0) {
                              cancelresp = true;    
                            } else {
                            cancelresp = false;    
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount1 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr1 + "' ";
                            stmt.addBatch(query);
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount2 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr2 + "' ";
                            stmt.addBatch(query);
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount3 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr3 + "' ";
                            stmt.addBatch(query);
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + currAmount4 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr4 + "' ";
                            stmt.addBatch(query);
                            query = "Update " + txnLibrary + ".PYP00501  set TCSTATUS =  'C'  where  TCREFNUM = '" + txnRef + "' ";
                            stmt.addBatch(query);
                            query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                            stmt.addBatch(query);
                            query = "update " + txnLibrary + ".PYP00301  set TRSTATUS = 'C', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                            stmt.addBatch(query);
                            }

                    }catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                break;

            
            case "FCS":
                    try {
                        
                         if (vr.checkTillValue(till, lkrAmount, "LKR") == true) {
                                     count++;
                                     break;
                         }
                        if (count > 0) {
                              cancelresp = true;    
                        } else {
                        cancelresp = false;                            
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + currAmount1 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr1 + "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYP00501  set TCSTATUS =  'C'  where  TCREFNUM = '" + txnRef + "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                        stmt.addBatch(query);
                        query = "update " + txnLibrary + ".PYP00301  set TRSTATUS = 'C', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                        stmt.addBatch(query);
                        }

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCR":
                    try {
                        
                         if (vr.checkTillValue(till, lkrAmount, "LKR") == true) {
                                     count++;
                                     break;
                         }
                        if (count > 0) {
                              cancelresp = true;    
                        } else {
                        cancelresp = false;                            
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + currAmount1 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr1 + "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYP00501  set TCSTATUS =  'C'  where  TCREFNUM = '" + txnRef + "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL - '" + lkrAmount + "'  where TPTILID = '" + till + "' and TPCURID = 'LKR' ";
                        stmt.addBatch(query);
                        query = "update " + txnLibrary + ".PYP00301  set TRSTATUS = 'C', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                        stmt.addBatch(query);
                        }

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCI":
                    try {
                                                 
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + currAmount1 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr1+ "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYP00501  set TCSTATUS =  'C'  where  TCREFNUM = '" + txnRef + "' ";
                        stmt.addBatch(query);
                        query = "update " + txnLibrary + ".PYP00301  set TRSTATUS = 'C', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                        stmt.addBatch(query);

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                 case "PFC":
                    try {
                        
                        query = "Update " + txnLibrary + ".PYT00601  set TPCURBAL = TPCURBAL + '" + currAmount1 + "'  where TPTILID = '" + till + "' and TPCURID = '" + curr1 + "' ";
                        stmt.addBatch(query);
                        query = "Update " + txnLibrary + ".PYP00501  set TCSTATUS =  'C'  where  TCREFNUM = '" + txnRef + "' ";
                        stmt.addBatch(query);
                        query = "update " + txnLibrary + ".PYP00301  set TRSTATUS = 'C', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                        stmt.addBatch(query);

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;   
                    
            }
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
            if (cancelresp == true) {
                resp = "insufficient";
            } else if (cancelresp == false) {
                if (result.length == 0){
                    resp = "false";
                } else if (result.length > 0){
                    resp = "true";
                }
            }
    
        } catch (Exception e) {
            logger.error("Error in revert cancel : ", e);
        }
        return resp;
//////////////////////
    }
    
    public String rejectCancelTransaction(String txnRef, String user, String reason, String ip, String hostname) throws ClassNotFoundException, SQLException, JSONException {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();
            try {
                String query = "update " + txnLibrary + ".PYP00301  set TRAUTSTA = 'R', TRSTATUS = '', TRAUTUSR='" + user + "', TRAUTRES = '" + reason + "', TRAUTTIM = '" + getCurrentTimeStamp() + "'  where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";

                resp = insertTableData.insertTableData(query);
            } catch (Exception e) {
                logger.error("Error in remove user data : ", e);
            }
            try {
                if (!resp) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("userReference", "ERROR");
                    jSONObject.put("errorMessage", "Error in  Cancel Transaction.");
                } else {
                    jSONObject.put("errorStatus", false);
                    
                    jSONObject.put("errorMessage", "");
                }
            } catch (Exception e) {
                logger.error(e);
            }
        
        
        return jSONObject.toString();
    }

    public String changeTransactionState(String txnRef, String user, String reason, String ip, String hostname) {
        String resp = "";
        boolean cancelresp = false;

        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        VaultRepository vr = new VaultRepository();
        Statement stmt = null;
        int[] result = null;
        Connection con = null;
        String curr = null;
        String currAmount = null;
        JSONObject jSonObj = new JSONObject();
        jSonObj = retriveTxnData(txnRef);
        int count = 0;
        String query ="";
       
        try {
            String txnType = jSonObj.getString("txnType");

            String curr1 = jSonObj.getString("curr1");
            String curr2 = jSonObj.getString("curr2");
            String curr3 = jSonObj.getString("curr3");
            String curr4 = jSonObj.getString("curr4");

            String lkrAmount = jSonObj.getString("lkrAmount");
            String till = jSonObj.getString("tillId");

            String currAmount1 = jSonObj.getString("currAmount1");
            String currAmount2 = jSonObj.getString("currAmount2");
            String currAmount3 = jSonObj.getString("currAmount3");
            String currAmount4 = jSonObj.getString("currAmount4");


                try {
                    con = DbConnection.getConnection();
                    stmt = con.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                            ResultSet.CONCUR_UPDATABLE);
                    stmt = con.createStatement();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                


                switch (txnType) {
                    case "FCP":
                        try {

                            for (int i = 0; i < 4; i++) {
                                if (i == 0) {
                                    curr = curr1;
                                    currAmount = currAmount1;

                                } else if (i == 1) {
                                    curr = curr2;
                                    currAmount = currAmount2;

                                } else if (i == 2) {
                                    curr = curr3;
                                    currAmount = currAmount3;

                                } else {
                                    curr = curr4;
                                    currAmount = currAmount4;

                                }
                                
                                if (vr.checkTillValue(till, currAmount, curr) == true) {
                                     count++;
                                     break;
                                }
                                
                            }
                            
                            if (count > 0) {
                              cancelresp = true;    
                            } else {
                            cancelresp = false;    
                            query = "update " + txnLibrary + ".PYP00301 "
                                + " set TRSTATUS = 'X', TRCANUSR='" + user + "', TRCANRES = '" + reason + "',"
                                + " TRCANTIM = '" + getCurrentTimeStamp() + "'  "
                                + "where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                         stmt.addBatch(query);
                            }

                    }catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                break;

            
            case "FCS":
                    try {
                        
                         if (vr.checkTillValue(till, lkrAmount, "LKR") == true) {
                                     count++;
                                     break;
                         }
                        if (count > 0) {
                              cancelresp = true;    
                        } else {
                        cancelresp = false;                            
                        query = "update " + txnLibrary + ".PYP00301 "
                                + " set TRSTATUS = 'X', TRCANUSR='" + user + "', TRCANRES = '" + reason + "',"
                                + " TRCANTIM = '" + getCurrentTimeStamp() + "'  "
                                + "where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                         stmt.addBatch(query);
                        }

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCR":
                    try {
                        
                         if (vr.checkTillValue(till, lkrAmount, "LKR") == true) {
                                     count++;
                                     break;
                         }
                        if (count > 0) {
                              cancelresp = true;    
                        } else {
                        cancelresp = false;                            
                        query = "update " + txnLibrary + ".PYP00301 "
                                + " set TRSTATUS = 'X', TRCANUSR='" + user + "', TRCANRES = '" + reason + "',"
                                + " TRCANTIM = '" + getCurrentTimeStamp() + "'  "
                                + "where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                         stmt.addBatch(query);
                        }

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                case "FCI":
                    try {
                                                 
                        query = "update " + txnLibrary + ".PYP00301 "
                                + " set TRSTATUS = 'X', TRCANUSR='" + user + "', TRCANRES = '" + reason + "',"
                                + " TRCANTIM = '" + getCurrentTimeStamp() + "'  "
                                + "where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                         stmt.addBatch(query);

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;
                 case "PFC":
                    try {
                        
                         query = "update " + txnLibrary + ".PYP00301 "
                                + " set TRSTATUS = 'X', TRCANUSR='" + user + "', TRCANRES = '" + reason + "',"
                                + " TRCANTIM = '" + getCurrentTimeStamp() + "'  "
                                + "where TRREFNUM = '" + txnRef.replaceAll("\\s+", "") + "'";
                         stmt.addBatch(query);

                    } catch (Exception e) {
                        logger.error("Error in update pyt00601 data from DB : ", e);
                    }
                    break;   
                    
            }
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
            if (cancelresp == true) {
                resp = "insufficient";
            } else if (cancelresp == false) {
                if (result.length == 0){
                    resp = "false";
                } else if (result.length > 0){
                    resp = "true";
                }
            }
    
        } catch (Exception e) {
            logger.error("Error in revert cancel : ", e);
        }
        return resp;
//////////////////////
    }
  

    public String getPendingCancellationList() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {

            String query = "select      TRIM(txn.TRREFNUM) as REFNO, "
                    + "txn.TRUINCOD as UINTYPE, "
                    + "txn.TRTXNTYP as TXNTYPE, "
                    + "TRIM(txn.TRUINNUM) as UINNUMBER, "
                    + "TRIM(txn.TRACCNUM) as ACCNUMBER, "
                    + "TRIM(txn.TRCURR1) as CURR1, "
                    + "TRIM(txn.TRCURR2) as CURR2, "
                    + "TRIM(txn.TRCURR3) as CURR3, "
                    + "TRIM(txn.TRCURR4) as CURR4, "
                    + "txn.TRAMT1 as AMOUNT1, "
                    + "txn.TRAMT2 as AMOUNT2, "
                    + "txn.TRAMT3 as AMOUNT3, "
                    + "txn.TRAMT4 as AMOUNT4, "
                    + "TRIM(txn.TRNAME) as NAME, "
                    + "txn.TRSTATUS as STATUS, "
                    + "txn.TRINCAMT as INCENTIVE, "
                    + "txn.TRCOMAMT as COMMISION, "
                    + "txn.TRLKRTOT as LKRTOTAL, "
                    + "txn.TRCANRES as CANCELLEDREASON "
                    + " from " + txnLibrary + ".PYP00301 txn "
                    + "where TREFDATE =" + getManDateFormatted() + " and TRSTATUS='C' ";

            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get Transaction Sector codes details from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load Transaction Sector codes data : ", e);
        }
        return response;
    }

}
