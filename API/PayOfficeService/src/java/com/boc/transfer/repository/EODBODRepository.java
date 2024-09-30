/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.converter.JsonConvertor;
import com.boc.transfer.model.AcceptCash;
import com.boc.transfer.model.CurrencyTypes;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author it207664
 */
public class EODBODRepository {

    private static String dataLibrary;
    private static String txnLibrary;
    Logger logger = Logger.getLogger(TransactionRepository.class.getName());
    public Statement stmnt = null;
    public ResultSet rs = null;
    Connection con = null;

    public String getOperationHistory() {
        String response = "";
        GetDataLibrary library = new GetDataLibrary();
        JSONObject jSONObject = new JSONObject();
        JSONArray jSONArray = new JSONArray();
        txnLibrary = library.loadTxnLibraty();
        boolean errorStatus = false;
        try {
            String query = "select  TRIM(DAYDATE) as date, "
                    + "TRIM(DAYPROS) as processName, "
                    + "TRIM(DAYSTAT) as status, "
                    + "TRIM(DAYSTRT) as started, "
                    + "TRIM(DAYENDT) as ended, "
                    + "TRIM(DAYERCD) as error, "
                    + "TRIM(DAYUSER) as user "
                    + " from PYP01301 where DAYDATE= '" + getCurrentDateFormatted() + "' "
                    + " ORDER BY date DESC";

            GetTableData tableData = new GetTableData();
            response = tableData.getDBData(query);
        } catch (Exception e) {
            logger.error("Error in loadBasicData : ", e);
        }
        if (errorStatus == false) {
            return response;
        } else {
            jSONArray.put(jSONObject);
            return jSONArray.toString();
        }
    }

    public String checkPreCheckRunStatus() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        JSONObject jSONObject = new JSONObject();
        boolean errorStatus = false;
        String status = "F";
        try {
            String query = "select count(*) as entrycount "
                    + "from PYP01301 "
                    + "where DAYPROS='PRECHECK' and DAYSTAT='S' and  "
                    + "DAYDATE= " + getCurrentDateFormatted();
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {

                if (rs.getInt("entrycount") > 0) {
                    status = "S";
                    jSONObject.put("status", status);

                } else {
                    status = "F";
                    jSONObject.put("status", status);

                }
            }

        } catch (Exception e) {
            logger.error("Error in  DATA : ", e);
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
        return jSONObject.toString();
    }

    public String checkRunStatus(String operationType) {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        JSONObject jSONObject = new JSONObject();
        boolean errorStatus = false;
        String status = "F";
        try {
            String query = "select TRIM(DAYSTAT) as status "
                    + "from PYP01301 "
                    + "where DAYPROS='" + operationType + "' and "
                    + "DAYDATE= " + getCurrentDateFormatted();

            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                status = rs.getString("status");
            }
            jSONObject.put("status", status);
        } catch (Exception e) {
            logger.error("Error in  DATA : ", e);
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
        return jSONObject.toString();
    }

    public String startPreCheckOperation(String user) {
        JSONObject jSONObject = new JSONObject();
        InsertTableData insertTableData = new InsertTableData();
        String status = "S";
        boolean resp = true;

        String effectiveDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
        try {
            String query1 = "select sum(TPCURBAL) as BALANCE from PYT00601 where TPTILID <>1";

            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query1);
            while (rs.next()) {

                if (rs.getInt("BALANCE") > 0) {
                    status = "F";
                    jSONObject.put("status", status);
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "All Teller Balances Have Not Been Transferred to Main Vault");

                    try {
                        String query = "INSERT INTO PYP01301(DAYDATE, DAYPROS, DAYSTAT, DAYERCD,"
                                + "DAYUSER,DAYSTRT,DAYENDT,DAYONCE"
                                + ") values ('" + effectiveDate + "','PRECHECK','" + status + "','ERROR'"
                                + ",'" + user + "','" + timeStamp + "', '" + timeStamp + "', 'Y')";

                        resp = insertTableData.insertTableData(query);
                    } catch (Exception e) {
                        logger.error("Error in assign user data : ", e);
                    }

                } else {
                    status = "S";
                    jSONObject.put("status", status);
                    jSONObject.put("errorStatus", false);
                    jSONObject.put("errorMessage", "Success");
                    
                    try {
                        String query = "INSERT INTO PYP01301(DAYDATE, DAYPROS, DAYSTAT, DAYERCD,"
                                + "DAYUSER,DAYSTRT,DAYENDT,DAYONCE"
                                + ") values ('" + effectiveDate + "','PRECHECK','" + status + "','SUCCESS'"
                                + ",'" + user + "','" + timeStamp + "', '" + timeStamp + "', 'Y')";

                        resp = insertTableData.insertTableData(query);
                    } catch (Exception e) {
                        logger.error("Error in assign user data : ", e);
                    }

                }
            }

        } catch (Exception e) {
            logger.error("Error in  startPreCheckOperation : ", e);
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
        return jSONObject.toString();
    }

    public String startDayEndOperation(String user) {

        List<CurrencyTypes> currTypes = new ArrayList<>();
        Connection con = null;
        Statement stmnt = null;
        ResultSet rs = null;
        boolean resp = true;
        InsertTableData insertTableData = new InsertTableData();
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        JSONObject jSONObject = new JSONObject();
        String effectiveDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
        String fcp = "FCP";
        String fcs = "FCS";
        String fcr = "FCR";
       
        try {
            try {
                        String query2 = "INSERT INTO PYP01301(DAYDATE, DAYPROS, DAYSTAT, DAYERCD,"
                                + "DAYUSER,DAYSTRT,DAYENDT,DAYONCE"
                                + ") values ('" + effectiveDate + "','DAYEND','S','SUCCESS'"
                                + ",'" + user + "','" + timeStamp + "', '" + timeStamp + "', 'Y')";

                        resp = insertTableData.insertTableData(query2);
                    } catch (Exception e) {
                        logger.error("Error in assign user data : ", e);
                    }
            
            //Read currency list from pyp00201 and create an array
            String query = "select CURSHRT from PYP00201 where CURSHRT <> 'LKR'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            try {
                stmnt = con.createStatement();
                rs = stmnt.executeQuery(query);
                while (rs.next()) {
                    CurrencyTypes cTypes = new CurrencyTypes();
                    cTypes.setCurShrt(rs.getString("CURSHRT"));
                    currTypes.add(cTypes);

                }
            } catch (SQLException Ex) {
                logger.error("Error get currency Rates data : ", Ex);
            }

            // get currency list from pyp00201 
            for (int i = 0; i < currTypes.size(); i++) {
                generateFCPCashSummary(currTypes.get(i).getCurShrt());
                generateFCSCashSummary(currTypes.get(i).getCurShrt()); 
                generateFCRCashSummary(currTypes.get(i).getCurShrt()); 
            }
                generateLKRCashSummary(fcp);
                generateLKRCashSummary(fcs);
                generateLKRCashSummary(fcr);
            
            

        } catch (Exception e) {
            logger.error("Error in get day end operation  : ", e);
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
        return jSONObject.toString();
  }


    


 
    
       


    private String getCurrentDateFormatted() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyyMMdd");
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
        
   
        
    private String generateFCPCashSummary(String currency) {
            
        Double sumbal = 0.00;
        Statement stmt = null;
        Connection conn = null;
        
        int[] resultBatch = null;
        JSONObject jSONObject = new JSONObject();
        String currentDate = getManDateFormatted(); 
        
        
        
        try {
            try {
                    conn = DbConnection.getConnection();
                    stmt = conn.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                            ResultSet.CONCUR_UPDATABLE);
                    stmt = conn.createStatement();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }    
            String query1 =  "select sum(TRAMT1)as CUR1SUM from PYP00301 where  TRCURR1 = '" + currency + "' and TRTXNTYP = 'FCP' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query1);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR1SUM"); 
                        try {
                            String query11 = "UPDATE PYP01601 SET SUMCUR1=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmt.addBatch(query11);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCP Cash Summary Query1: ", e);
            }
        
        try {
                String query2 =  "select sum(TRAMT2)as CUR2SUM from PYP00301 where  TRCURR2 = '" + currency + "' and TRTXNTYP = 'FCP' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query2);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR2SUM"); 
                        try {
                            String query21 = "UPDATE PYP01601 SET SUMCUR2=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmt.addBatch(query21);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCP Cash Summary Query2: ", e);
            }
        
        try {
                String query3 =  "select sum(TRAMT3)as CUR3SUM from PYP00301 where  TRCURR3 = '" + currency + "' and TRTXNTYP = 'FCP' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query3);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR3SUM"); 
                        try {
                            String query31 = "UPDATE PYP01601 SET SUMCUR3=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmt.addBatch(query31);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCP Cash Summary Query3: ", e);
            }
        
        try {
                String query4 =  "select sum(TRAMT4)as CUR4SUM from PYP00301 where  TRCURR4 = '" + currency + "' and TRTXNTYP = 'FCP' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmt.executeQuery(query4);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR4SUM"); 
                        try {
                            String query41 = "UPDATE PYP01601 SET SUMCUR4=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmnt.addBatch(query41);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCP Cash Summary Query4: ", e);
            }
        
            
        
            try {
                    resultBatch = stmt.executeBatch();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows inserted :" + resultBatch.length);

            } catch (Exception e) {
                     System.out.println(e.getMessage());
                    logger.error("Error in update FCP cash summary to PYP01601: ", e);
            }
                try {
                    if (resultBatch.length == 0) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Error");
                        
                    } else if (resultBatch.length > 0) {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
                return jSONObject.toString();
          
    }
    
    
    private String generateFCSCashSummary(String currency) {
            
        Double sumbal = 0.00;
        Statement stmt = null;
        Connection conn = null;
        int[] resultBatch = null;
        JSONObject jSONObject = new JSONObject();
        String currentDate = getManDateFormatted(); 
        
        try {
            try {
                    conn = DbConnection.getConnection();
                    stmt = conn.createStatement(ResultSet.TYPE_SCROLL_SENSITIVE,
                            ResultSet.CONCUR_UPDATABLE);
                    stmt = conn.createStatement();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                String query1 =  "select sum(TRAMT1)as CUR1SUM from PYP00301 where  TRCURR1 = '" + currency + "' and TRTXNTYP = 'FCS' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query1);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR1SUM"); 
                        try {
                            String query11 = "UPDATE PYP01701 SET SUMCUR1=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmt.addBatch(query11);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCS Cash Summary Query1: ", e);
            }
        
        try {
                    resultBatch = stmt.executeBatch();
                   // con.commit();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows executed :" + resultBatch.length);

            } catch (Exception e) {
                    logger.error("Error in update FCS cash summary to PYP01701: ", e);
            }
                try {
                    if (resultBatch.length == 0) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Error");
                        
                    } else if (resultBatch.length > 0) {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
                return jSONObject.toString();
          
    }
    
    private String generateFCRCashSummary(String currency) {
            
        Double sumbal = 0.00;
        Statement stmt = null;
        Connection conn = null;
        int[] resultBatch = null;
        JSONObject jSONObject = new JSONObject();
        String currentDate = getManDateFormatted(); 
        
        try {
                String query1 =  "select sum(TRAMT1)as CUR1SUM from PYP00301 where  TRCURR1 = '" + currency + "' and TRTXNTYP = 'FCR' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query1);
                    while (rs.next()) {
                        sumbal = rs.getDouble("CUR1SUM"); 
                        try {
                            String query11 = "UPDATE PYP01801 SET SUMCUR1=" + sumbal + " where CURTYPE = '" + currency + "'";
                            stmt.addBatch(query11);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate FCR Cash Summary Query1: ", e);
            }
        
        try {
                    resultBatch = stmt.executeBatch();
                    //con.commit();
                    stmt.clearBatch();
                    stmt.close();
                    System.out.println("Number of rows executed :" + resultBatch.length);

            } catch (Exception e) {
                    logger.error("Error in update FCR cash summary to PYP01801: ", e);
            }
                try {
                    if (resultBatch.length == 0) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Error");
                        
                    } else if (resultBatch.length > 0) {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
                return jSONObject.toString();
          
    } 
    
    private String generateLKRCashSummary(String txntype) {
            
        String sumbal = "";
        Statement stmt = null;
        int[] resultBatch = null;
        JSONObject jSONObject = new JSONObject();
        String currentDate = getManDateFormatted(); 
        
        try {
                String query1 =  "select sum(TRLKRTOT)as LKRTOTAL from PYP00301 where  TRTXNTYP = '" + txntype + "' and TREFDATE = '" + currentDate + "'"; 
                try {
                    con = DbConnection.getConnection();
                } catch (SQLException e) {
                    logger.error("Error in create connection : ", e);
                }
                    stmnt = con.createStatement();
                    rs = stmnt.executeQuery(query1);
                    while (rs.next()) {
                        sumbal = rs.getString("LKRTOTAL"); 
                        try {
                            String query11 = "UPDATE PYP01901 SET LKRTOTAL='" + sumbal + "' where TXNTYP = '" + txntype + "'";
                            stmnt.addBatch(query11);
                        } catch (Exception e) {
                            logger.error("Error in remove user data : ", e);
                        }
                    }
            } catch (Exception e) {
                logger.error("Error in generate LKR Cash Summary Query1: ", e);
            }
      
        try {
                    resultBatch = stmnt.executeBatch();
                    con.commit();
                    stmnt.clearBatch();
                    stmnt.close();
                    System.out.println("Number of rows executed :" + resultBatch.length);

            } catch (Exception e) {
                    logger.error("Error in update LKR cash summary to PYP01901: ", e);
            }
                try {
                    if (resultBatch.length == 0) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Error");
                        
                    } else if (resultBatch.length > 0) {
                        jSONObject.put("errorStatus", false);
                        jSONObject.put("errorMessage", "");
                    }
                } catch (Exception e) {
                    logger.error(e);
                }
                return jSONObject.toString();
          
    }
    
   public String getDailySummaryData() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadDataLibraty();
        String response = "";
        
        try {
            String query = "SELECT r.CURTYPE as curshrt, "
                        + "r.SUMCUR1 as fcpsum, "
                        + "r.SUMCUR2 as fcssum, "
                        + "r.SUMCUR3 as fcrsum "
                        
                        + "FROM PYP01601 r "
                        + "order by r.CURTYPE ";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in getDailySummaryData from DB : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in getDailySummaryData : ", e);
        }
        return response;
    } 
   


}
