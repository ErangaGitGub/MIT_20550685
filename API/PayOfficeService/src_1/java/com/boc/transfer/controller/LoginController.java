/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.UserHandler;
import javax.ws.rs.Consumes;
import javax.ws.rs.HeaderParam;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.MediaType;
import org.apache.log4j.Logger;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;

/**
 * @author pns
 */
@Path("user")
public class LoginController {

    Logger logger = Logger.getLogger(LoginController.class.getName());

    @POST
    @Path("getUserData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getUserData(@HeaderParam("apiKey") String key, String userJson) {
        logger.debug("getUserData");
        String userName = "";
        String ip = "";
        String mName = "";
        String userData = "";
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONParser parser = new JSONParser();
                Object obj = parser.parse(userJson);
                JSONObject obj2 = (JSONObject) obj;

                userName = (String) obj2.get("userName");
                ip = (String) obj2.get("ip");
                mName = (String) obj2.get("mName");
                if ("".equals(userName) || userName == null) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "User id is required.");
                    return jSONObject.toString();
                } else if ("".equals(ip) || ip == null) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Ip address is required.");
                    return jSONObject.toString();
                } else if ("".equals(mName) || mName == null) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Matchine name is required.");
                    return jSONObject.toString();
                } else {
                    UserHandler handler = new UserHandler();
                    userData = handler.getUserData(userName, ip, mName);
                }

            }
        } catch (Exception ex) {
            logger.warn("Error in getUserData", ex);
        }
        return userData;
    }

}
