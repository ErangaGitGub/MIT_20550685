/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;


import com.boc.transfer.handler.TransactionHandler;
import com.boc.transfer.handler.UserHandler;
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
 * @author it207416
 */
@Path("vault")
public class VaultController {
    
    Logger logger = Logger.getLogger(VaultController.class.getName());
      
    @POST
    @Path("getCurrencyList/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCurrencyList(@HeaderParam("apiKey") String key) {
        logger.debug("getCurrencyList");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String currencyList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                VaultHandler handler = new VaultHandler();
                currencyList = handler.getCurrencyList();
            }
        } catch (Exception ex) {
            logger.warn("Error in getCurrencyList", ex);
        }
        return currencyList;
    }

    @POST
    @Path("getPreviousDayOpeningBalance/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getPreviousDayOpeningBalance(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getPreviousDayOpeningBalance");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String previousDayOpeningBalances = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "tillID is required.");
                    return jSONObject.toString();
                }else{
                    VaultHandler handler = new VaultHandler();
                    previousDayOpeningBalances = handler.getPreviousDayOpeningBalance(jsonObj.getString("tillID"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in previousDayOpeningBalances", ex);
        }
        return previousDayOpeningBalances;
    }
    
    @POST
    @Path("getCurrencyListWithBalance/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCurrencyListWithBalance(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getCurrencyListWithBalance");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String currencyListWithBalance = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "tillID is required.");
                    return jSONObject.toString();
                }else{
                    VaultHandler handler = new VaultHandler();
                    currencyListWithBalance = handler.getCurrencyListWithBalance(jsonObj.getString("tillID"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in previousDayOpeningBalances", ex);
        }
        return currencyListWithBalance;
    }
    
    @POST
    @Path("insertToPOS/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertToPOS(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("insertToPOS");
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
                } else if (!jsonObj.has("sourceTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "sourcetill  is required.");
                    return jSONObject.toString();
                    } else if (!jsonObj.has("destTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "desttill  is required.");
                    return jSONObject.toString();
                } else {

                    VaultHandler handler = new VaultHandler();

                    response = handler.insertToPOS(formJson);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in assignUserData", ex);
        }
        return response;
    }
    
    @POST
    @Path("insertToT4S/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertToT4S(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("insertToT4S");
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
                } else if (!jsonObj.has("sourceTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "sourcetill  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("destTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "desttill  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("remarks")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "remarks required.");
                    return jSONObject.toString();
                } else {

                    VaultHandler handler = new VaultHandler();

                    response = handler.insertToT4S(formJson);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in insertToT4S", ex);
        }
        return response;
    }
    
    @POST
    @Path("tillToTill/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String tillToTill(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("assignUserData");
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
                } else if (!jsonObj.has("sourceTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "source till  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("destTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "destination till  is required.");
                    return jSONObject.toString();
                } else {
                    VaultHandler handler = new VaultHandler();
                    response = handler.tillToTill(formJson);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in assignUserData", ex);
        }
        return response;
    }
    
    @POST
    @Path("getTillBalance/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTillBalance(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getPendingTransfers");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "tillID is required.");
                    return jSONObject.toString();
                }else{
                    VaultHandler handler = new VaultHandler();
                    response = handler.getTillBalance(jsonObj.getString("tillID"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getPendingTransfers", ex);
        }
        return response;
    } 
    
    @POST
    @Path("getPendingTransfers/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getPendingTransfers(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getPendingTransfers");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "tillID is required.");
                    return jSONObject.toString();
                }else{
                    VaultHandler handler = new VaultHandler();
                    response = handler.getPendingTransfers(jsonObj.getString("tillID"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getPendingTransfers", ex);
        }
        return response;
    }
    
    @POST
    @Path("getCashTransfers/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCashTransfers(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getCashTransfers");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "tillID is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("type")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Type is required.");
                    return jSONObject.toString();
                }else{
                    VaultHandler handler = new VaultHandler();
                    response = handler.getCashTransfers(jsonObj.getString("tillID"), jsonObj.getString("type"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getPendingTransfers", ex);
        }
        return response;
    }
    
    @POST
    @Path("acceptRejectAllTransfers/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String acceptRejectAllTransfers(@HeaderParam("apiKey") String key, String actionJson) {
        logger.debug("acceptRejectAllTransfers");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(actionJson);
                if (!jsonObj.has("user_till")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "user_till  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("action")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "action  is required.");
                    return jSONObject.toString();
                } else {
                    VaultHandler handler = new VaultHandler();
                    response = handler.acceptRejectAllTransfers(jsonObj.getString("user_till"), jsonObj.getString("action"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in acceptRejectAllTransfers", ex);
        }
        return response;
    }
    
    @POST
    @Path("acceptCashToTill/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String acceptCashToTill(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("acceptCashToTill");
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

                if (!jsonObj.has("sourceTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "sourceTill  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("destTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "destTill  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("curr")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "curr  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("amount")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "amount  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("user")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "user  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("timestamp")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "timestamp  is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("status")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "status  is required.");
                    return jSONObject.toString();
                } else {
                    VaultHandler handler = new VaultHandler();
                    response = handler.acceptCashToTill(jsonObj.getString("sourceTill"), jsonObj.getString("destTill"), jsonObj.getString("curr"), jsonObj.getString("amount"), jsonObj.getString("user"), jsonObj.getString("timestamp"), jsonObj.getString("status"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in assignUserData", ex);
        }
        return response;
    }
}

    
