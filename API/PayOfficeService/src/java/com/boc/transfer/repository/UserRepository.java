/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.model.CurrencyAmounts;
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
import java.time.format.DateTimeFormatter;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Properties;
import java.util.logging.Level;
import org.apache.log4j.Logger;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author it207458
 */
public class UserRepository {

    private static String environmrnt, dataLibrary, txnLibrary, operatorLevel, bClassLevel, aClassLevel, dealer;
    Logger logger = Logger.getLogger(UserRepository.class.getName());
    private int branchExists, userExists;
    
    public String getUserData(String userName) {

        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;  
        JSONObject resultJson = new JSONObject();

        try {
            String query = "select UMUSRID, UMUSRPF, UMUSRPW, UMUSRNM, UMUSRBR, UMUSRST from PYP00901 where "
                    + "UMUSRPF = '" + userName + "'";
            
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);

            
            while (rs.next()) {
                resultJson.put("id", rs.getInt("UMUSRID"));
                resultJson.put("username", rs.getString("UMUSRPF"));
                resultJson.put("password", rs.getString("UMUSRPW"));
                resultJson.put("fullname", rs.getString("UMUSRNM"));
                resultJson.put("branchcode", rs.getString("UMUSRBR"));
                resultJson.put("status", rs.getString("UMUSRST"));
            }
        } catch (Exception e) {
            logger.error("Error in getUserData : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in getUserData", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in getUserData", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }
        }
        return resultJson.toString();
    }
   
    public List getDataNew(String userName) {
        loadEnvoronment();
        GetDataLibrary library = new GetDataLibrary();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        List list = new ArrayList();
        UserData data = new UserData();
//        String userID = userName.substring(2);
        String userID = userName.toUpperCase();
        txnLibrary = library.loadTxnLibraty();
        dataLibrary = library.loadDataLibraty();
        boolean state = false;
        String effDate = getManDateFormatted();
//        String effDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());

        //////
        try {
            String query1 = "SELECT UMUSRPF as userid , "
                    + "UMUSRNM as name , "
                    + "UMUSRST as status , "
                    + "UMUSRBR as branch "
                    + "FROM PYP00901 "
                    + "where "
                    + "UMUSRPF like '%" + userID + "%'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query1);
            while (rs.next()) {
                data.setUserId(rs.getString("userid"));
                data.setBranchCode(rs.getString("branch"));
                data.setName(rs.getString("name"));
                data.setUserStatus(rs.getString("status"));
                }
            con.close();
            rs.close();
            stmnt.close();
        } catch (Exception e) {
            logger.error("Error in get user details : ", e);
        }
        try {
            String query2 = "select max(ULDATE) as lastLogDate, max(ULTIME) as lastLogTime from  pyp01101  where "
                    + " ULDATE = (select  max(ULDATE) from  pyp01101  where  ULUSRID like '%" + userID + "%') ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query2);
            while (rs.next()) {
                data.setLastlogDate(rs.getString("lastLogDate"));
                data.setLastLogTime(rs.getString("lastLogTime"));
            }
            con.close();
            rs.close();
            stmnt.close();
        } catch (Exception e) {
            logger.error("Error in create connection : ", e);
        }

        try {
            String query3 = "select a.UALEVEL as userLevel, a.UAEFDATE as effectiveDate, a.UATILL as userTill, b.TILDESC as tillDesc, c.ULDESC as levelDesc "
                    + " from  PYP01001 a, PYP00401 b, PYP00801 c "
                    + "  where  a.UAUSRPF like '%" + userID + "%' "
                    + " and UASTAT = 'A' and a.UATILL=b.TILIDNO and a.UALEVEL=c.ULIDNO";
            
            System.out.println(query3);
            
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query3);
            while (rs.next()) {
                
            if ("Admin". equalsIgnoreCase(rs.getString("levelDesc").trim())){
                    data.setUserLevel(rs.getString("userLevel"));
                    data.setUserTill(rs.getString("userTill"));
                    data.setUserLevelDesc(rs.getString("levelDesc"));
                    data.setUserTillDesc(rs.getString("tillDesc"));
                                      
            }   else {
                
                try {
                                String query4 = "select a.UALEVEL as userLevel, a.UAEFDATE as effectiveDate, a.UATILL as userTill, b.TILDESC as tillDesc, c.ULDESC as levelDesc "
                                        + " from  pyp01001 a, pyp00401 b, pyp00801 c "
                                        + "  where  a.UAUSRPF like '%" + userID + "%' and a.UAEFDATE = '" + effDate + "' "
                                        + " and UASTAT = 'A' and a.UATILL=b.TILIDNO and a.UALEVEL=c.ULIDNO";
                                try {
                                    con = DbConnection.getConnection();
                                } catch (SQLException e) {
                                    logger.error("Error in create connection : ", e);
                                }
                                stmnt = con.createStatement();
                                rs = stmnt.executeQuery(query4);
                                while (rs.next()) {
                                    data.setUserLevel(rs.getString("userLevel"));
                                    data.setUserTill(rs.getString("userTill"));
                                    data.setUserLevelDesc(rs.getString("levelDesc"));
                                    data.setUserTillDesc(rs.getString("tillDesc"));
                                    data.setEffectiveDate(rs.getString("effectiveDate"));
                                }
                                con.close();
                                rs.close();
                                stmnt.close();
                            } catch (Exception e) {
                                logger.error("Error in create connection : ", e);
                            }
                
                 
            
            } 
                
            
            }    con.close();
            rs.close();
            stmnt.close();
        } catch (Exception e) {
            logger.error("Error in create connection : ", e);
        }
          
        
//        try {
//            String query4 = "select count(*) as ratecount from  " + txnLibrary + ".pyp00701  where "
//                    + " RPDATE = '" + effDate + "' and RPSTAT = 'A' ";
//            try {
//                con = DbConnection.getConnection();
//            } catch (SQLException e) {
//                logger.error("Error in create connection : ", e);
//            }
//            stmnt = con.createStatement();
//            rs = stmnt.executeQuery(query4);
//            while (rs.next()) {
//                if (rs.getInt("ratecount") > 0){
//                    data.setRateStatus("Y");
//                }else {
//                    data.setRateStatus("N");
//                }
//         
//                
//            }
//            con.close();
//            rs.close();
//            stmnt.close();
//        } catch (Exception e) {
//            logger.error("Error in create connection : ", e);
//        }
       
//////////////////////

        //Set branchcode 0 for the dealer
        if ("..STPDEALR".equalsIgnoreCase(data.getProfile())) {
            data.setBranchCode("0");
        }
        list.add(0, data);
        return list;
    }

    public boolean logUserData(String userID, String ip, String mName) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        try {
            DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyyMMdd");
            LocalDate localDate = LocalDate.now();
            String currentDate = dtf.format(localDate);
            Calendar cal = Calendar.getInstance();
            SimpleDateFormat sdf1 = new SimpleDateFormat("HH:mm:ss");
            String currentTime = sdf1.format(cal.getTime());
            String query = "INSERT INTO PYP01101(ULUSRID,ULIPADD,ULHOST,"
                    + "ULDATE,ULTIME) values('" + userID + "','" + ip + "','" + mName + "','" + currentDate + "',"
                    + "'" + currentTime + "')";
            resp = insertTableData.insertTableData(query);
        } catch (Exception e) {
            logger.error("Error in logUserData : ", e);
        }
        return resp;
    }

    private void loadEnvoronment() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            //String current = UserRepository.class.getProtectionDomain().getCodeSource().getLocation().getPath();
            //String[] pathArr = current.split("classes/");
            //String root = pathArr[0] + "/classes/com/boc/transfer/properties/config.properties";
            //input = new FileInputStream(root);
            input = UserRepository.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            environmrnt = prop.getProperty("icbs.user.environment");
            dataLibrary = prop.getProperty("icbs.data.library");
            operatorLevel = prop.getProperty("user.level.operator");
            bClassLevel = prop.getProperty("user.level.b.class");
            aClassLevel = prop.getProperty("user.level.a.class");
            dealer = prop.getProperty("user.level.dealer");

        } catch (Exception e) {
            logger.error("Error in loadEnvoronment : ", e);
        }

    }

    public List<PermitionData> getPermitionData(String userLevel, int clusterId) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        List<PermitionData> permitionDatas = new ArrayList<>();
        try {
            // String query = "SELECT * FROM " + dataLibrary + ".FNTP01301 WHERE FT13CID = " + clusterId + " and "
            //         + "FT13ULEVEL LIKE '" + userLevel + "%' and FT13ISALOW = 1";
            String query = "SELECT * FROM " + dataLibrary + ".FNTP01301 WHERE FT13CID = " + clusterId + " and "
                    + "FT13ULEVEL = '" + userLevel + "' and FT13ISALOW = 1";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(query);
                while (rs.next()) {
                    PermitionData data = new PermitionData();
                    data.setId(rs.getInt("FT13ID"));
                    data.setClusterId(rs.getInt("FT13CID"));
                    data.setClusterCode(rs.getString("FT13CCODE"));
                    data.setUserLevel(rs.getString("FT13ULEVEL").trim());
                    data.setIsAllow(rs.getInt("FT13ISALOW"));

                    data.setInitialView(rs.getInt("FT13VIEWIN"));
                    data.setInitialAdd(rs.getInt("FT13ADDIN"));
                    data.setInitialModify(rs.getInt("FT13MODIIN"));
                    data.setInitialVerification(rs.getInt("FT13VERYIN"));
                    data.setInitialAuthorization(rs.getInt("FT13AUTHIN"));

                    data.setAditionallView(rs.getInt("FT13VIEWID"));
                    data.setAditionalAdd(rs.getInt("FT13ADDID"));
                    data.setAditionalModify(rs.getInt("FT13MODIID"));
                    data.setAditionalVerification(rs.getInt("FT13VERYID"));
                    data.setAditionalAuthorization(rs.getInt("FT13AUTHID"));

                    data.setInqueryAll(rs.getInt("FT13INQU"));
                    data.setReportsAll(rs.getInt("FT13REPO"));

                    data.setMessageSelection(rs.getInt("FT13MESSAG"));
                    data.setNostroSelection(rs.getInt("FT13NOSTRO"));

                    data.setSystemManager(rs.getInt("FT13SYSMAN"));
                    data.setConfigManager(rs.getInt("FT13CONMAN"));

                    data.setAllocateFund(rs.getInt("FT13AFUND"));
                    data.setAllocateRate(rs.getInt("FT13ARATE"));
                    data.setViewFund(rs.getInt("FT13AFDVEW"));
                    data.setViewRate(rs.getInt("FT13ARTVEW"));
                    data.setPaymentView(rs.getInt("FT13PVIEW"));
                    data.setViewAllFund(rs.getInt("FT13FVIEW"));
                    data.setViewAllRate(rs.getInt("FT13RVIEW"));

                    data.setSendSMS(rs.getInt("FT13SNDSMS"));
                    data.setSendEMail(rs.getInt("FT13SNDMAL"));
                    data.setPrintReceipt(rs.getInt("FT13PRTRE"));
                    data.setLogView(rs.getInt("FT13LGVEW"));

                    data.setOptionsView(rs.getInt("FT13OPVIEW"));
                    data.setCancelRequest(rs.getInt("FT13CANREQ"));

                    data.setSaveOnly(rs.getInt("FT13SONLY"));
                    data.setUserSelect(rs.getInt("FT13USELEC"));

                    permitionDatas.add(data);
                }
            } catch (SQLException Ex) {
                logger.error("Error get user basic data : ", Ex);
            }

        } catch (Exception e) {
            logger.error("Error in getPermitionData : ", e);
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
        return permitionDatas;
    }

    public String getBranchUserList() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select username as USERPF, fullname as USERNAME "
                    + "from USERS ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getBranchUserList from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getBranchUserList : ", e);
        }
        return response;
    }
   
    public String getSystemDate() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;  
        JSONObject resultJson = new JSONObject();


        try {
            String query = "select substr(mandate,1,4) concat '-' concat substr(mandate,5,2) concat '-' concat substr(mandate,7,2) as SYSTEMDATE "
                    + "from PYP00102 ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                resultJson.put("systemdate", rs.getString("SYSTEMDATE"));
                }
            } catch (Exception e) {
            logger.error("Error in getSystemDatee : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in getSystemDate", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in getSystemDate", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }
        }
        return resultJson.toString();
    } 
 
    public String getEffectiveDate() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select mandate as SYSTEMDATE "
                    + "from PYP00102 ";
//            String query = "select substr(mandate,1,4) concat '-' concat substr(mandate,5,2) concat '-' concat substr(mandate,7,2) as SYSTEMDATE "
//                    + "from PYP00102 ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getEffectiveDate from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getEffectiveDate : ", e);
        }
        return response;
    }    
    
    public String getCurrencyList() {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String response = "";
        try {
            String query = "select RTCURID as CURID, "
                    + "RTCURPET as CURHRT, "
                    + "RTCURDESC as CURDESC"
                    + "from " + dataLibrary + ".PYT00701 ";
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
    public String getBranchUserData(String pfNumber) {

        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;  
        JSONObject resultJson = new JSONObject();

        try {
            String query = "select a.umusrnm as USERNAME, a.umusrbr as BRCODE, b.CFBRNM as BRNAME "
                    + "from PYP00901 a, CFP102 b "
                    + "where a.umusrbr = b.CFBRCH and UMUSRPF = '" + pfNumber + "'";
            
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                resultJson.put("username", rs.getString("USERNAME"));
                resultJson.put("branchcode", rs.getString("BRCODE"));
                 resultJson.put("branchname", rs.getString("BRNAME"));
            }
        } catch (Exception e) {
            logger.error("Error in getBranchUserData : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in getBranchUserData", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in getBranchUserData", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }
        }
        return resultJson.toString();
        
    }

        public String insertUserData(UserData txn) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        JSONObject resultJson = new JSONObject();
        boolean errorStatus = true;
        boolean resp = true;
        ////
        try {
            if (checkDuplicatePf(txn.getPfNumber()) == false) {
                try {
                    DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyyMMdd");
                    LocalDate localDate = LocalDate.now();
                    String currentDate = dtf.format(localDate);
                    Calendar cal = Calendar.getInstance();
                    SimpleDateFormat sdf1 = new SimpleDateFormat("HH:mm:ss");
                    String currentTime = sdf1.format(cal.getTime());
                    String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
                    //String query = "INSERT INTO " + txnLibrary + ".PYP00901(UMUSRID,UMUSRPF,UMUSRNM,"
                    String query = "INSERT INTO PYP00901(UMUSRPF, UMUSRPW, UMUSRNM, UMUSRBR,"
                            + "UMUSRST,UMENDAT,UMENUSR,UMENIP,UMENHOST"
                            + ") values ('" + txn.getPfNumber() + "','" + txn.getPassword()+ "','" + txn.getName() + "','" + txn.getBranch()+ "'"
                            + ",'" + 'A' + "','" + timeStamp + "'"
                            + ",'" + txn.getEnteredUser() + "','" + txn.getEnteredIP() + "','" + txn.getEnteredHost() + "')";

                    resp = insertTableData.insertTableData(query);
                    if (resp == true) {
                        errorStatus = false;
                        resultJson.put("pfNumber", txn.getPfNumber());
                    } else {
                        resultJson.put("error_message", "Error insert user data.");
                    }
                    resultJson.put("error_status", errorStatus);
                   // resultJson.put("duplicate", "false");
                } catch (Exception e) {
                    logger.error("Error in insertUserData : ", e);
                }
            } else {
                try {
                    errorStatus = true;
                    resultJson.put("pfNumber", txn.getPfNumber());
                    resultJson.put("error_message", "User has already been registered in the system");
                    resultJson.put("error_status", errorStatus);
                } catch (Exception e) {
                    logger.error("Error in data inserting of duplicatePF Json : ", e);
                }
            }
        } catch (Exception e) {
            logger.error("Error in retrieving checkDuplicatePf : ", e);
        }
        return resultJson.toString();
    }
       
    private boolean checkDuplicatePf(String pfNumber) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean response = false;
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        try {
            String query = "select UMUSRPF as USERPF "
                    + "from PYP00901 "
                    + "where UMUSRPF like '%" + pfNumber + "%' and UMUSRST = 'A' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                response = true;
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
    
    public String assignUserData(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();
        String effectiveDate = usr.getEffectiveDate().replaceAll("-", "");
        String systemDate =  getManDateFormatted();
        if ((alreadyAssignUser(usr) == false)&&(alreadyAssignRole(usr)==false)) {
            try {
                String query = "INSERT INTO PYP01001 "
                        + "(UAUSRPF, UAUSRNM, UAEFDATE, UASYDATE, UALEVEL, UATILL, UASTAT, UAENDAT,"
                        + " UAENIP, UAENHOST, UAENUSR) "
                        + " values ('"
                        + usr.getPfNumber() + "', '"
                        + usr.getName() + "', '"
                        + effectiveDate + "','"
                        + systemDate + "','"
                        + usr.getUserLevel() + "', '"
                        + usr.getuserTill() + "', '"
                        + "A', '"
                        + getCurrentTimeStamp() + "', '"
                        + usr.getEnteredIP() + "', '"
                        + usr.getEnteredHost() + "', '"
                        + usr.getEnteredUser() + "' )";

                resp = insertTableData.insertTableData(query);
            } catch (Exception e) {
                logger.error("Error in assign user data : ", e);
            }
            try {
                if (!resp) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("userReference", "ERROR");
                    jSONObject.put("errorMessage", "Error in Save Assigned User Data.");
                } else {
                    jSONObject.put("errorStatus", false);
                    jSONObject.put("userReference", usr.getPfNumber());
                    jSONObject.put("errorMessage", "");
                }
            } catch (Exception e) {
                logger.error(e);
            }
        } else {
            try {
                jSONObject.put("errorStatus", true);
                jSONObject.put("userReference", usr.getPfNumber());
                jSONObject.put("errorMessage", "User or role has been already assigned");
            } catch (JSONException ex) {
                java.util.logging.Logger.getLogger(UserRepository.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        return jSONObject.toString();
    }

    private boolean alreadyAssignUser(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean response = false;
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String effectiveDate = usr.getEffectiveDate().replaceAll("-", "");
        try {
            String query = "select * "
                    + "from PYP01001 "
                    + "where UAUSRPF = '" + usr.getPfNumber() + "' "
                    + "and UAEFDATE = '" + effectiveDate + "' and UASTAT ='A' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                response = true;

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
    
    private boolean alreadyAssignRole(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean response = false;
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        String effectiveDate = usr.getEffectiveDate().replaceAll("-", "");
        try {
            String query = "select * "
                    + "from PYP01001 "
                    + "where UATILL = '" + usr.getuserTill() + "' and UALEVEL = '"
                    + usr.getUserLevel() + "' and UAEFDATE = '" + effectiveDate + "' and UASTAT = 'A' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                response = true;

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
    
    public String removeUserData(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();
        if (checkLiveStatus(usr) == false) {
            try {
                String query = "UPDATE PYP00901 "
                        + " SET UMUSRST='D' WHERE UMUSRPF = '" + usr.getPfNumber() + "'";

                resp = insertTableData.insertTableData(query);
            } catch (Exception e) {
                logger.error("Error in remove user data : ", e);
            }
            try {
                if (!resp) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("userReference", "ERROR");
                    jSONObject.put("errorMessage", "Error in  Delete User Data.");
                } else {
                    jSONObject.put("errorStatus", false);
                    jSONObject.put("userReference", usr.getPfNumber());
                    jSONObject.put("errorMessage", "");
                }
            } catch (Exception e) {
                logger.error(e);
            }
        }else{
             try {
                 jSONObject.put("errorStatus", true);
                    jSONObject.put("userReference", "ERROR");
                    jSONObject.put("errorMessage", "User has been allocated to  a role. Please de-allocate and try again");
                  } catch (Exception e) {
                logger.error(e);
            }
             }
        
        return jSONObject.toString();
    }
    
    public String resetUserPassword(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();
        try {
            String query = "UPDATE PYP00901 "
                    + " SET UMUSRPW= '" + usr.getResetPassword() + "' WHERE UMUSRPF = '" + usr.getPfNumber() + "'";

            resp = insertTableData.insertTableData(query);

            if (!resp) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("userReference", "ERROR");
                jSONObject.put("errorMessage", "Error in  Password Reset.");
            } else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("userReference", usr.getPfNumber());
                jSONObject.put("errorMessage", "");
            }

        } catch (Exception e) {
            logger.error("Error in password reset data : ", e);
        }
        
        return jSONObject.toString();
    }
    
    public String changeUserPassword(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();
        try {
            String query = "UPDATE PYP00901 "
                    + " SET UMUSRPW= '" + usr.getPassword() + "' WHERE UMUSRPF = '" + usr.getPfNumber() + "'";

            resp = insertTableData.insertTableData(query);

            if (!resp) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("userReference", "ERROR");
                jSONObject.put("errorMessage", "Error in  Change Password.");
            } else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("userReference", usr.getPfNumber());
                jSONObject.put("errorMessage", "");
            }

        } catch (Exception e) {
            logger.error("Error in password change data : ", e);
        }
        
        return jSONObject.toString();
    }

    private boolean checkLiveStatus(UserData usr) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        boolean response = false;
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;

        try {
            String query = "select * "
                    + "from PYP01001 "
                    + "where UAUSRPF = '" + usr.getPfNumber() + "' and UASTAT = 'A' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                response = true;

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
    
    public String removeUserAssignData(String pfnumber, String userlevel, String usertill, String effdate) {
        GetDataLibrary library = new GetDataLibrary();
        InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        boolean resp = false;
        JSONObject jSONObject = new JSONObject();

        List<CurrencyAmounts> currencyAmounts = new ArrayList<>();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        int tillNo = 0;
        //////////////////////
        ///
        try {
            String queryOne = "select TILIDNO "
                    + "from PYP00401 where TILDESC= '" + usertill + "' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(queryOne);
                while (rs.next()) {
                   tillNo = rs.getInt("TILIDNO");
                }
            } catch (SQLException Ex) {
                logger.error("Error get commission Rates data : ", Ex);
            }
        } catch (Exception Ex) {
            logger.error("Error get commission Rates data : ", Ex);
        }
        ///

        try {
            String query = "select TPCURBAL,TPCURID "
                    + "from PYT00601 where TPTILID = '" + tillNo + "' ";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(query);
                while (rs.next()) {
                    CurrencyAmounts currAmounts = new CurrencyAmounts();
                    currAmounts.setCurr(rs.getString("TPCURID"));
                    currAmounts.setCurrAmount(rs.getDouble("TPCURBAL"));
                    currencyAmounts.add(currAmounts);
                }
            } catch (SQLException Ex) {
                logger.error("Error get commission Rates data : ", Ex);
            }
            int j = 0;
            for (int i = 0; i < currencyAmounts.size(); i++) {
                if (currencyAmounts.get(i).getCurrAmount() > 0.0) {
                    j++;
                    break;
                }
            }
            if ((j == 0)||(tillNo==1)) {
                try {
                    String newQuery = "UPDATE PYP01001 "
                            + " SET UASTAT ='D' WHERE UAUSRPF = '" + pfnumber + "' and UAEFDATE= '" + effdate + "' ";

                    resp = insertTableData.insertTableData(newQuery);
                } catch (Exception e) {
                    logger.error("Error in remove user data : ", e);
                }
                try {
                    if (!resp) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("userReference", "ERROR");
                        jSONObject.put("errorMessage", "Error in  Remove User Assignement Data.");
                    } else {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("userReference", pfnumber);
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
            } else {
                jSONObject.put("errorStatus", true);
                jSONObject.put("userReference", "ERROR");
                jSONObject.put("errorMessage", "User is currently allocated to a working till");
            }
        } catch (Exception Ex) {
            logger.error("Error get commission Rates data : ", Ex);
        }

        //////////////////////
        return jSONObject.toString();
    }
    
    public String getSystemUsers() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select UMUSRPF as USERPF,"
                    + " UMUSRNM as USERNAME, "
                    + "UMUSRST as STATUS, "
                    + "UMENDAT as ENROLLEDDATE, "   
                    + "UMENUSR  as ENROLLEDUSER "   
                    + "from PYP00901 ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getUserList from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getUserList : ", e);
        }
        return response;
    }
    
    public String getDailyAssignments() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String effDate = getManDateFormatted();
        try {
            String query = "select UAUSRPF as USERPF,"
                    + " UAUSRNM as USERNAME, "
                    + " ULDESC as USERLEVEL, "
                    + " TILDESC as USERTILL, "
                    + " UAEFDATE as EFFDATE, "
                    + "UASTAT as STATUS, "
                    + "UAENDAT as ASSIGNDDATE, "   
                    + "UAENUSR  as ASSIGNUSER "   
                    + "from PYP01001 a,"
                    + "PYP00801 b,"
                    + "PYP00401 c "
                    + "where a.UALEVEL= b.ULIDNO "
                    + " and a.UATILL= c.TILIDNO and ( UASYDATE = '" + effDate + "' or UAEFDATE = '" + effDate + "') ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getDailyAssignments from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getDailyAssignments : ", e);
        }
        return response;
    }
    
    public String getUserLevels() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select ULIDNO as LEVELID,"
                    + " ULDESC as LEVELDESC "
                    + "from PYP00801 ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getUserLevels from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getUserLevels : ", e);
        }
        return response;
    }
    
    public String getUserAssignmentList() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        String currentDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        //String currentDate = "20220719";
        try {
            String query = "select UAUSRPF,UAUSRNM,UALEVEL,UATILL "
                    + "from PYP01001 where UAEFDATE = '" + currentDate + "' ";
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getPendingTransfers from DB : ", e);
            }
       
        return response;
    }
   
    public String getTills() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select TILIDNO as TILLID,"
                    + " TILDESC as TILLDESC "
                    + "from PYP00401 "
                    + "where TILSTAT='A'";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getTills from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getTills : ", e);
        }
        return response;
    }
    
     private String getCurrentTimeStamp() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
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
                    + "from  PYP00102 ";

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
