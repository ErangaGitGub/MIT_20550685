/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.UserHandler;
import com.boc.transfer.model.UserData;
import javax.ws.rs.Consumes;
import javax.ws.rs.HeaderParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.apache.log4j.Logger;
import org.json.JSONObject;
import org.json.simple.parser.JSONParser;

/**
 *
 * @author Eranga
 */
@Path("auth")
public class AuthController {
    
    Logger logger = Logger.getLogger(UserController.class.getName());
    
    @POST
    @Path("login/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String userLogin(@HeaderParam("apiKey") String key, String jsonData) {
        
        JSONObject jsonRequestObj=null;
        JSONObject jsonResponseObject=null;
                
        try {
            ApiAuthontication authontication = new ApiAuthontication();
           
            jsonRequestObj = new JSONObject(jsonData);
            jsonResponseObject = new JSONObject();
        
            if (!authontication.isUserAuthenticated(key)) {
                jsonResponseObject.put("errorStatus", true);
                jsonResponseObject.put("errorMessage", "User not authenticated");
            } else {
                UserHandler handler = new UserHandler();
               
                String username = jsonRequestObj.getString("username");
                String password = jsonRequestObj.getString("password");
                
                String responseString = handler.getAuthUser(username);
                JSONObject obj = new JSONObject(responseString);
 
                UserData userData = handler.getUserData(username);

                jsonResponseObject.put("errorStatus", "");
                jsonResponseObject.put("errorMessage", "");
                jsonResponseObject.put("status", true);
                jsonResponseObject.put("password", obj.get("password"));

            }
        } catch (Exception ex) {
            logger.warn("Error in authenticateUser", ex);
        }
        
        return jsonResponseObject.toString();
    }
    
    @POST
    @Path("getuser/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getUser(@HeaderParam("apiKey") String key, String jsonData) {
        
        JSONObject jsonRequestObj=null;
        JSONObject jsonResponseObject=null;
                
        try {
            ApiAuthontication authontication = new ApiAuthontication();
           
            jsonRequestObj = new JSONObject(jsonData);
            jsonResponseObject = new JSONObject();
        
            if (!authontication.isUserAuthenticated(key)) {
                jsonResponseObject.put("errorStatus", true);
                jsonResponseObject.put("errorMessage", "User not authenticated");
            } else {
                UserHandler handler = new UserHandler();
               
                String username = jsonRequestObj.getString("username");

                    
                UserData userData = handler.getUserData(username);

                jsonResponseObject.put("errorStatus", "");
                jsonResponseObject.put("errorMessage", "");
                jsonResponseObject.put("status", true);
                jsonResponseObject.put("userID", userData.getUserId().trim());
                jsonResponseObject.put("branchCode", userData.getBranchCode());
                jsonResponseObject.put("branchName", userData.getBranchName());
                jsonResponseObject.put("name", userData.getName().trim());
                jsonResponseObject.put("userStatus", userData.getUserStatus());
                jsonResponseObject.put("lastLogDate",userData.getLastlogDate());
                jsonResponseObject.put("lastLogTime", userData.getLastLogTime());
                jsonResponseObject.put("userLevel", userData.getUserLevel());
                jsonResponseObject.put("userTill", userData.getUserTill());
                jsonResponseObject.put("userLevelDesc", userData.getUserLevelDesc());
                jsonResponseObject.put("userTillDesc", userData.getUserTillDesc());
                    
                
            }
        } catch (Exception ex) {
            logger.warn("Error in authenticateUser", ex);
        }
        
        return jsonResponseObject.toString();
    }
    
}
