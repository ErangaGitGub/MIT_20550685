/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.CommunicatorHandler;
import com.boc.transfer.handler.VaultHandler;
import javax.ws.rs.Consumes;
import javax.ws.rs.HeaderParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.apache.log4j.Logger;
import org.json.JSONObject;

/**
 *
 * @author it203886
 */
@Path("comm")
public class CommunicatorController {

    Logger logger = Logger.getLogger(VaultController.class.getName());

    @POST
    @Path("getFCICommunicator/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
   public String getFCICommunicator(@HeaderParam("apiKey") String key, String tillJson) {
   
        logger.debug("getCommunicator");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String currencyList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                 JSONObject jsonObj = new JSONObject(tillJson);
                CommunicatorHandler handler = new CommunicatorHandler();
                currencyList = handler.executeFCITransaction(jsonObj.getString("fromAcct"), jsonObj.getString("fromAccountType"), jsonObj.getString("toAcct"), jsonObj.getString("toAccountType"), jsonObj.getString("amt"),jsonObj.getString("commission"),jsonObj.getString("descrpt"),jsonObj.getString("txnRef"));
            //currencyList = handler.executeEpayTransaction1(jsonObj.getString("amt"),jsonObj.getString("commission"));
            }
        } catch (Exception ex) {
            logger.warn("Error in getCurrencyList", ex);
        }
        return currencyList;
    }
   
   
   @POST
    @Path("getPFCCommunicator/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
   public String getPFCCommunicator(@HeaderParam("apiKey") String key, String tillJson) {
   
        logger.debug("getCommunicator");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String currencyList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                 JSONObject jsonObj = new JSONObject(tillJson);
                CommunicatorHandler handler = new CommunicatorHandler();
                currencyList = handler.executePFCTransaction(jsonObj.getString("fromAcct"), jsonObj.getString("fromAccountType"), jsonObj.getString("toAcct"), jsonObj.getString("toAccountType"), jsonObj.getString("amt"),jsonObj.getString("currency"),jsonObj.getString("descrpt"),jsonObj.getString("txnRef"));
            //currencyList = handler.executeEpayTransaction1(jsonObj.getString("amt"),jsonObj.getString("commission"));
            }
        } catch (Exception ex) {
            logger.warn("Error in getCurrencyList", ex);
        }
        return currencyList;
    }
   
}
