/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.TransactionHandler;
import com.boc.transfer.handler.UserHandler;
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
@Path("usr")
public class UserController {
    
    Logger logger = Logger.getLogger(UserController.class.getName());
    

    @POST
    @Path("getSystemDate/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getSystemDate(@HeaderParam("apiKey") String key) {
        logger.debug("getSystemDate");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String systemDate = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                UserHandler handler = new UserHandler();
                systemDate = handler.getSystemDate();
            }
        } catch (Exception ex) {
            logger.warn("Error in getSystemDate", ex);
        }
        return systemDate;
    }
 
    @POST
    @Path("getEffectiveDate/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getEffectiveDate(@HeaderParam("apiKey") String key) {
        logger.debug("getEffectiveDate");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String systemDate = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                UserHandler handler = new UserHandler();
                systemDate = handler.getEffectiveDate();
            }
        } catch (Exception ex) {
            logger.warn("Error in getEffectiveDate", ex);
        }
        return systemDate;
    }
    
    @POST
    @Path("getBranchUserList/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getBranchUserList(@HeaderParam("apiKey") String key) {
        logger.debug("getBranchUserList");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String branchUserList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                UserHandler handler = new UserHandler();
                branchUserList = handler.getBranchUserList();
            }
        } catch (Exception ex) {
            logger.warn("Error in getBranchUserList", ex);
        }
        return branchUserList;
    }
    
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
                UserHandler handler = new UserHandler();
                currencyList = handler.getCurrencyList();
            }
        } catch (Exception ex) {
            logger.warn("Error in getCurrencyList", ex);
        }
        return currencyList;
    }
    
    @POST
    @Path("getBranchUserData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getBranchUserData(@HeaderParam("apiKey") String key, String pfJson) {
        logger.debug("getBranchUserData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String branchUserData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(pfJson);
                if (!jsonObj.has("pfNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "PF Number  is required.");
                    return jSONObject.toString();
                }else{
                    UserHandler handler = new UserHandler();
                    branchUserData = handler.getBranchUserData(jsonObj.getString("pfNumber"));
                    
                } 
            }
        } catch (Exception ex) {
            logger.warn("Error in getBranchUserData", ex);
        }
        return branchUserData;
    }
    
    
  @POST
    @Path("insertUserData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertUserData(@HeaderParam("apiKey") String key, String pfJson) {
        logger.debug("saveUserData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(pfJson);
                if (!jsonObj.has("pfNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "PF Number  is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userName")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Name  is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("ip")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "ip  is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("host")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "host  is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("user")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "user  is required.");
                    return jSONObject.toString();
                }
                else{
                    String pfNumber = jsonObj.getString("pfNumber");
                    String userName = jsonObj.getString("userName");
                    String ip = jsonObj.getString("ip");
                    String host = jsonObj.getString("host");
                    String user = jsonObj.getString("user");
                    UserHandler handler = new UserHandler();
                    response = handler.insertUserData(pfNumber,userName,ip,host,user);
                    
                } 
            }
        } catch (Exception ex) {
            logger.warn("Error in insertUserData", ex);
        }
        return response;
    }
    
    
    @POST
    @Path("assignUserData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String assignUserData(@HeaderParam("apiKey") String key, String formJson) {
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
                if (!jsonObj.has("pfNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "pfNumber is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userName")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userName is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userLevel")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userLevel is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userTill is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("effectiveDate")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "effectiveDate is required.");
                    return jSONObject.toString();
                } else{
                    UserHandler handler = new UserHandler();
                    response = handler.assignUserData(jsonObj);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in assignUserData", ex);
        }
        return response;
    }
    
    @POST
    @Path("removeUserData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String removeUserData(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("removeUserData");
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
                if (!jsonObj.has("pfNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "pfNumber is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userName")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userName is required.");
                    return jSONObject.toString();
                } else{
                    UserHandler handler = new UserHandler();
                    response = handler.removeUserData(jsonObj);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in removeUserData", ex);
        }
        return response;
    }
    
    @POST
    @Path("removeUserAssignData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String removeUserAssignData(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("removeUserAssignData");
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
                if (!jsonObj.has("pfNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "pfNumber is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userName")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userName is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userLevel")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userLevel is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "userTill is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("effDate")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "effDate is required.");
                    return jSONObject.toString();
                } else{
                    UserHandler handler = new UserHandler();
                    response = handler.removeUserAssignData(jsonObj.getString("pfNumber"), jsonObj.getString("userLevel"), jsonObj.getString("userTill"), jsonObj.getString("effDate"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in removeUserData", ex);
        }
        return response;
    }
    
    
    @POST
    @Path("getSystemUsers/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getSystemUsers(@HeaderParam("apiKey") String key) {
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
                  
                UserHandler handler = new UserHandler();
                response = handler.getSystemUsers();
               
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
    @Path("getDailyAssignments/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getDailyAssignments(@HeaderParam("apiKey") String key) {
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
                  
                UserHandler handler = new UserHandler();
                response = handler.getDailyAssignments();
               
                    if (response.length() <= 2) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Records not found.");
                        jSONArray.put(jSONObject);
                        response = jSONArray.toString();
                    }
                
            }
        } catch (Exception e) {
            logger.error("Error in getDailyAssignments : ", e);
        }
        return response;
    }
    
    
    @POST
    @Path("getUserLevels/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getUserLevels(@HeaderParam("apiKey") String key) {
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
                  
                UserHandler handler = new UserHandler();
                response = handler.getUserLevels();
               
                    if (response.length() <= 2) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Records not found.");
                        jSONArray.put(jSONObject);
                        response = jSONArray.toString();
                    }
                
            }
        } catch (Exception e) {
            logger.error("Error in getUserLevels : ", e);
        }
        return response;
    }
    
    @POST
    @Path("getUserAssignmentList/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getUserAssignmentList(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("getPendingTransfers");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            
                }else{
                    UserHandler handler = new UserHandler();
                    response = handler.getUserAssignmentList();
                
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getPendingTransfers", ex);
        }
        return response;
    }
  
    @POST
    @Path("getTills/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTills(@HeaderParam("apiKey") String key) {
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
                  
                UserHandler handler = new UserHandler();
                response = handler.getTills();
               
                    if (response.length() <= 2) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Records not found.");
                        jSONArray.put(jSONObject);
                        response = jSONArray.toString();
                    }
                
            }
        } catch (Exception e) {
            logger.error("Error in getTills : ", e);
        }
        return response;
    }
}

    
