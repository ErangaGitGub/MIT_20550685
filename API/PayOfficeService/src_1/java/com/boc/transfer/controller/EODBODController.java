/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.EODBODHandler;
import javax.ws.rs.Consumes;
import javax.ws.rs.HeaderParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONObject;

/**
 *
 * @author it207664
 */
@Path("eodbod")
public class EODBODController {
    
    Logger logger = Logger.getLogger(EODBODController.class.getName());
    @POST
    @Path("getOperationHistory/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getOperationHistory(@HeaderParam("apiKey") String key) {
        String response = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        JSONArray jSONArray = new JSONArray();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                EODBODHandler handler  = new EODBODHandler();
                response = handler.getOperationHistory();
                if (response.length() <= 2) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Records not found.");
                    jSONArray.put(jSONObject);
                    response = jSONArray.toString();
                }
            }
        } catch (Exception e) {
            logger.error("Error in loadBasicData : ", e);
        }
        return response;
    }
    
       
    @POST
    @Path("startOperation/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String startOperation(@HeaderParam("apiKey") String key, String dataJson) {
        String response = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(dataJson);
                if (!jsonObj.has("operationType")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Operation type is required.");
                        return jSONObject.toString();
                    } else {
                    EODBODHandler handler = new EODBODHandler();
                    String operationType = jsonObj.getString("operationType");
                    String user = jsonObj.getString("user");
                    response = handler.startOperation(operationType, user);
                }
            }
        } catch (Exception e) {
            logger.error("Error in initial data insert : ", e);
        }
        return response;
    }
    
        
    @POST
    @Path("checkRunStatus/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String checkRunStatus(@HeaderParam("apiKey") String key, String dataJson) {
        String response = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(dataJson);
                if (!jsonObj.has("operationType")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Operation type is required.");
                        return jSONObject.toString();
                    } else {
                    EODBODHandler handler = new EODBODHandler();
                    String operationType = jsonObj.getString("operationType");
                    response = handler.checkRunStatus(operationType);
                }
            }
        } catch (Exception e) {
            logger.error("Error in initial data insert : ", e);
        }
        return response;
    }
    
    @POST
    @Path("checkPreCheckRunStatus/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String checkPreCheckRunStatus(@HeaderParam("apiKey") String key) {
        String response = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                  EODBODHandler handler = new EODBODHandler();
                  response = handler.checkPreCheckRunStatus();
            }
           
        } catch (Exception e) {
            logger.error("Error in initial data insert : ", e);
        }
        return response;
    }
    
    
    @POST
    @Path("generateReports/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String generateReports(@HeaderParam("apiKey") String key, String dataJson) {
        String response = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(dataJson);
                if (!jsonObj.has("reportName")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Report Name  is required.");
                        return jSONObject.toString();
                }else if (!jsonObj.has("user")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "User is required.");
                        return jSONObject.toString();
                } else {
                    EODBODHandler handler = new EODBODHandler();
                    String reportName = jsonObj.getString("reportName");
                    String user = jsonObj.getString("user");
                    response = handler.generateReports(reportName, user);
                }
            }
        } catch (Exception e) {
            logger.error("Error in initial data insert : ", e);
        }
        return response;
    }
}
