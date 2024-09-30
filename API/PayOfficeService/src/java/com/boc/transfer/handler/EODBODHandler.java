/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;

import com.boc.transfer.repository.EODBODRepository;
import com.boc.transfer.repository.TransactionRepository;
import com.boc.transfer.repository.RPGRepository;
import org.apache.log4j.Logger;
import org.json.JSONObject;

/**
 *
 * @author it207664
 */
public class EODBODHandler {
    
    Logger logger = Logger.getLogger(EODBODHandler.class.getName());
    
    
    public String getOperationHistory() {
        String response = "";
        try {
            EODBODRepository repository = new EODBODRepository();
            response = repository.getOperationHistory();
        } catch (Exception e) {
            logger.error("Error in getBasicData : ", e);
        }
        return response; 
    }
    
    
    public String startPreCheckOperation(String user) {
     
        boolean resp = false;
        boolean errorStatus = false;
        String response = "";
        String operation = "";
        JSONObject responseJson = new JSONObject();
        try {         
            EODBODRepository repository = new EODBODRepository();
            response = repository.startPreCheckOperation(user);                 
        } catch (Exception ex) {
             logger.error("Error in startPreCheckOperation : ", ex);
        }
        return response;
    }
    
    public String startDayEndOperation(String user) {
     
        boolean resp = false;
        boolean errorStatus = false;
        String response = "";
        String operation = "";
        JSONObject responseJson = new JSONObject();
        try {         
            EODBODRepository repository = new EODBODRepository();
            response = repository.startDayEndOperation(user);                 
        } catch (Exception ex) {
             logger.error("Error in startDayEndOperation : ", ex);
        }
        return response;
    }
    
    public String checkRunStatus(String operationType){
        EODBODRepository repository = new EODBODRepository();
        String response = "";
        try {
            response = repository.checkRunStatus(operationType);    
        } catch (Exception ex) {
             logger.error("Error in set innitial data save error message : ", ex);
        }
        return response;
    }
    
    public String checkPreCheckRunStatus(){
        EODBODRepository repository = new EODBODRepository();
        String response = "";
        try {
            response = repository.checkPreCheckRunStatus();    
        } catch (Exception ex) {
             logger.error("Error in set innitial data save error message : ", ex);
        }
        return response;
    }
    
    
    public String generateReports(String reportName, String user) {
        String operation = "";
        JSONObject responseJson = new JSONObject();
        try {
            RPGRepository rpgRepository = new RPGRepository();
            switch(reportName) {
                case "report1" :
                    operation = "DailyDetailReport";
                    break;
                case "report2" :
                    operation = "DailyCurrencyStatementReport";
                    break;
   
            }
            rpgRepository.executeRPGProgram(operation, user);      
        } catch (Exception ex) {
             logger.error("Error in set innitial data save error message : ", ex);
        }
        return responseJson.toString();
    }
    
     public String getDailySummaryData() {
        EODBODRepository repository = new EODBODRepository();
        String response = "";
        try {
            response = repository.getDailySummaryData();
        } catch (Exception ex) {
            logger.error("Error in getDailySummaryData : ", ex);
        }
        return response;
    }   
}
