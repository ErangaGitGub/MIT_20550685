/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.CurrencyHandler;
import com.boc.transfer.handler.TransactionHandler;
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
@Path("currency")
public class CurrencyController {

    Logger logger = Logger.getLogger(VaultController.class.getName());

    @POST
    @Path("insertCurrency/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertCurrency(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("insertCurrency");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(formJson);

                if (!jsonObj.has("user")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "User  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("ip")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "ip  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("host")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "host  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("reason")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "reason  is required.");
                    return jSONObject.toString();
                } else {
                    CurrencyHandler handler = new CurrencyHandler();
                    response = handler.insertCurrency(formJson);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in insertCurrency", ex);
        }
        return response;
    }
    
    
    @POST
    @Path("insertChequeData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertChequeData(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("insertChequeData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(formJson);
                
                    CurrencyHandler handler = new CurrencyHandler();
                    response = handler.insertChequeData(jsonObj);
                }
        } catch (Exception ex) {
            logger.warn("Error in getAccountData", ex);
        }
        return response;
    }
    
    
    @POST
    @Path("getRatesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getRatesData(@HeaderParam("apiKey") String key, String printTypeJson) {
        logger.debug("getRatesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String ratesData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(printTypeJson);
                if (!jsonObj.has("print_type")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Print Type is required.");
                    return jSONObject.toString();
                } else{
                    CurrencyHandler handler = new CurrencyHandler();
                    ratesData = handler.getRatesData(jsonObj.getString("print_type"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in getRatesData", ex);
        }
        return ratesData;
    }
    
    
    @POST
    @Path("getChequeData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getChequeData(@HeaderParam("apiKey") String key) {
        logger.debug("getChequeData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String chequeData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                CurrencyHandler handler = new CurrencyHandler();
                chequeData = handler.getChequeData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getChequeData", ex);
        }
        return chequeData;
    }
    
    @POST
    @Path("authorizeRejectCurrency/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String authorizeRejectCurrency(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("authorizeCurrency");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(formJson);

                if (!jsonObj.has("user")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "User  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("ip")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "ip  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("host")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "host  is required.");
                    return jSONObject.toString();
                } else {
                    CurrencyHandler handler = new CurrencyHandler();
                    response = handler.authorizeRejectCurrency(formJson);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error inauthorizeCurrency", ex);
        }
        return response;
    }
}
