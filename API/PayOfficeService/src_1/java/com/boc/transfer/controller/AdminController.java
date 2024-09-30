/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.AdminHandler;
import java.text.SimpleDateFormat;
import java.util.Date;
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
 * @author it207416
 */
@Path("admin")
public class AdminController {
    
    Logger logger = Logger.getLogger(TranasactionController.class.getName());
    
   @POST
    @Path("getTariffData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTariffData(@HeaderParam("apiKey") String key) {
        logger.debug("getTariffData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String tariffData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                AdminHandler handler = new AdminHandler();
                tariffData = handler.getTariffData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getTariffData", ex);
        }
        return tariffData;
    }
    
    @POST
    @Path("saveTariffData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String saveTariffData(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("saveTariffData");
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
                AdminHandler handler = new AdminHandler();
                response = handler.saveTariffData(formJson);
            }
            
        } catch (Exception ex) {
            logger.warn("Error in saveTariffData", ex);
        }
        return response;
    }
    

    
}


