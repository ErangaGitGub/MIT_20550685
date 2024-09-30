/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;


import com.boc.transfer.repository.AdminRepository;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Date;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author it207416
 */
public class AdminHandler {

    Logger logger = Logger.getLogger(TransactionHandler.class.getName());

   

    public String getTariffData() {
        AdminRepository repository = new AdminRepository();
        String response = "";
        try {
            response = repository.getTariffData();
        } catch (Exception ex) {
            logger.error("Error in get Tariff Data : ", ex);
        }
        return response;
    }
    
    public String saveTariffData(String formJson) {
        AdminRepository repository = new AdminRepository();
        String response = "";
        try {
            response = repository.saveTariffData(formJson);
        } catch (Exception ex) {
            logger.error("Error in saveTariffData : ", ex);
        }
        return response;
    }

    
    
}
    

    

