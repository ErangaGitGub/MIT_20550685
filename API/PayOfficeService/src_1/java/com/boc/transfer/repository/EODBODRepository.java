/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.converter.JsonConvertor;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.Date;
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
                    + " from " + txnLibrary + ".PYP01301 where DAYDATE= '"+ getManDateFormatted()+ "' "
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

    
    public String checkRunStatus(String operationType){
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        JSONObject jSONObject = new JSONObject();
        boolean errorStatus = false;
        String status = "F";
        try {
             String query = "select TRIM(DAYSTAT) as status "
                    + "from " + txnLibrary + ".PYP01301 "
                    + "where DAYPROS='" + operationType +"' and "
                    + "DAYDATE= "+ getManDateFormatted();
            
   
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
    
    public String checkPreCheckRunStatus(){
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        JSONObject jSONObject = new JSONObject();
        boolean errorStatus = false;
        String status = "F";
        try {
            String query = "select count(*) as entrycount "
                    + "from " + txnLibrary + ".PYP01301 "
                    + "where DAYPROS='Prior Check' and DAYSTAT='S' and  "
                    + "DAYDATE= "+ getManDateFormatted();
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);        
            while (rs.next()) {
                
                if (rs.getInt("entrycount") > 0){
                    status = "S"; 
                }else {
                    status = "F"; 
                }
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
   
}
