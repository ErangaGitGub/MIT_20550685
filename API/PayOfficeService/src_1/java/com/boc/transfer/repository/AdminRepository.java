/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.model.CommissionRates;
import com.boc.transfer.model.CurrencyAmounts;
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
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author it207416
 */
public class AdminRepository {

    Logger logger = Logger.getLogger(TransactionRepository.class.getName());
  
    private static String txnLibrary;

  

    public String getTariffData() {
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        String response = "";
        try {
            String query = "select TFTXNTYP,TFPASTYP, TFMAXVAL, TFCOMPER, TFCOMVAL, TFSTATUS "
                    + "from " + txnLibrary + ".PYP01201";
            try {
                GetTableData tableData = new GetTableData();
                response = tableData.getDBData(query);
            } catch (Exception e) {
                logger.error("Error in get TariffData : ", e);
            }
        } catch (Exception e) {
            logger.error("Error in load TariffData : ", e);
        }
        return response;
    }
    
   public String saveTariffData(String formJson) throws JSONException, ClassNotFoundException {
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
            String commission = jSONObject.getString("commission");
            String threshold = jSONObject.getString("threshold");
            String percentage = jSONObject.getString("percentage");
            String passtype = jSONObject.getString("passtype");
            String txntype = jSONObject.getString("txntype");
           
            jSONObject.remove("user");
            jSONObject.remove("ip");
           
            jsonArray = jSONObject.names();
            try {
                for (int i = 0; i < jsonArray.length(); i++) {

                    key = jsonArray.getString(i);
                    amount = jSONObject.getString(key).trim();
                  
                    try {
                        String query = "Update " + txnLibrary + ".PYP01201  set TFMAXVAL = '" + threshold + "' ,TFCOMPER = '" + percentage + "', TFCOMVAL = '" + commission + "'  where  TFTXNTYP = '" + txntype + "' and TFPASTYP = '" + passtype + "' ";

                        stmt.addBatch(query);
                    } catch (Exception e) {
                        logger.error("Error in update till data : ", e);
                    }

                
                }//end of if
            } catch (Exception e) {
                logger.error("Error in save tariff data: ", e);
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

    

}
