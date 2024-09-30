/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;

import com.boc.transfer.model.ITRSInternationalTxn;
import com.boc.transfer.model.UserData;
import com.boc.transfer.repository.BranchRepository;
import com.boc.transfer.repository.UserRepository;
import java.util.List;
import org.apache.log4j.Logger;
import org.json.JSONException;
import org.json.JSONObject;
import com.boc.transfer.generator.SerialNumber;
import com.boc.transfer.repository.TransactionRepository;
import java.util.ArrayList;

/**
 *
 * @author it207458
 */
public class UserHandler {

    Logger logger = Logger.getLogger(UserHandler.class.getName());
    private final boolean errorStatus = false;
    
    
    public String getAuthUser(String userName) {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getUserData(userName);
        } catch (Exception ex) {
            logger.error("Error in getAuthUser : ", ex);
        }
        return response;
    }

    public UserData getUserData(String userName) {
        String branchName = "";
        
        UserRepository repository = new UserRepository();
        List list = repository.getDataNew(userName);
        UserData userData = (UserData) list.get(0);
        
        if (!"".equals(userData.getBranchCode()) && !userData.getBranchCode().trim().equals("0")) {
            BranchRepository branchRepository = new BranchRepository();
            branchName = branchRepository.getBranchName(Integer.parseInt(userData.getBranchCode().trim()));
        }
        
        userData.setBranchName(branchName);
        

        return userData;
    }

    public String getBranchUserList() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getBranchUserList();
        } catch (Exception ex) {
            logger.error("Error in getBranchUserList : ", ex);
        }
        return response;
    }
 
    public String getSystemDate() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getSystemDate();
        } catch (Exception ex) {
            logger.error("Error in getSystemDate : ", ex);
        }
        return response;
    }
    
    public String getEffectiveDate() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getEffectiveDate();
        } catch (Exception ex) {
            logger.error("Error in geteffectiveDate : ", ex);
        }
        return response;
    }
    public String getCurrencyList() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getCurrencyList();
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    public String getBranchUserData(String pfNumber) {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getBranchUserData(pfNumber);
        } catch (Exception ex) {
            logger.error("Error in getBranchUserData : ", ex);
        }
        return response;
    }

    public String insertUserData(String pfNumber,String password,  String name, String branch, String ip, String host, String user) {
        UserRepository repository = new UserRepository();
        JSONObject jsonObj = new JSONObject();
        JSONObject jSONObject1 = new JSONObject();
        UserData txn = new UserData();
        SerialNumber dealSerialNumber = new SerialNumber();
        boolean resp = false;
        boolean errorStatus = false;
        String response = "";
        try {
            //txn.setUserId(dealSerialNumber.generatePayOffUserSerial());
            txn.setPfNumber(pfNumber);
            txn.setPassword(password);
            txn.setName(name);
            txn.setBranch(branch);
            txn.setEnteredIP(ip);
            txn.setEnteredHost(host);
            txn.setEnteredUser(user);
            response = repository.insertUserData(txn);
//            if (resp) {
//                errorStatus = false;
//                jSONObject1.put("errorStatus", false);
//            } else {
//                errorStatus = true;
//                jSONObject1.put("errorStatus", true);
//                jSONObject1.put("errorMessage", "Error insert user data.");
//            }
        } catch (Exception ex) {
            logger.error("Error in getBranchUserData : ", ex);
        }
        return response.toString();
    }
    
    public String assignUserData(JSONObject jSONObject) {
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateAssignUserDataRequest(jSONObject);
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = assignUser(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in assignUserData : ", ex);
        }
        return response;
    }
    
    private JSONObject validateAssignUserDataRequest(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            if (!jsonObj.has("pfNumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "pfNumber not found.");
            } else if (!jsonObj.has("userName")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "userName is required.");
            } else if (!jsonObj.has("userLevel")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "userLevel is required.");
            } else if (!jsonObj.has("userTill")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "userTill is required.");
            } else if (!jsonObj.has("effectiveDate")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "effectiveDate is required.");
            }
            else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initial json request : ", ex);
        }
        return jSONObject;
    }
    
    private String assignUser(JSONObject formJson) {
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        UserData usr = new UserData();
        try {
            usr.setPfNumber(formJson.getString("pfNumber"));
            usr.setName(formJson.getString("userName"));
            usr.setUserLevel(formJson.getString("userLevel"));
            usr.setuserTill(formJson.getString("userTill"));
            usr.setEnteredIP(formJson.getString("ip"));
            usr.setEnteredHost(formJson.getString("host"));
            usr.setEnteredUser(formJson.getString("user"));
            usr.setEffectiveDate(formJson.getString("effectiveDate"));
            
                     
            UserRepository repository = new UserRepository();
            resp = repository.assignUserData(usr);
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("UserReference", "USER PF NO");
                jSONObject1.put("errorMessage", "Error in assignUserData.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Load additional JSON data : ", e);
        }

        return resp;
    }
    
    public String removeUserData(JSONObject jSONObject) {
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateRemoveUserDataRequest(jSONObject);
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = removeUser(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in Remove User Data : ", ex);
        }
        return response;
    }
    
    public String resetPassword(JSONObject jSONObject) {
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateResetUserDataRequest(jSONObject);
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = resetUser(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in Reset User Password : ", ex);
        }
        return response;
    }
    
    public String changePassword(JSONObject jSONObject) {
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateChangeUserPasswordDataRequest(jSONObject);
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = changeUserPassword(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in Change User Password : ", ex);
        }
        return response;
    }
        
    public String removeUserAssignData(String pfnumber, String userlevel, String usertill, String effdate) {
        UserRepository repository = new UserRepository();
        String response = "";
        JSONObject jSONObject = new JSONObject();
        try {
            if ("ADMIN" .equals(userlevel)){
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User does not have privileges to remove ADMIN account");
                return jSONObject.toString();
            } else {
                response = repository.removeUserAssignData(pfnumber,userlevel, usertill, effdate);
            }
            
        } catch (Exception ex) {
            logger.error("Error in get system user data : ", ex);
        }
        return response;
    }
    
    private JSONObject validateRemoveUserDataRequest(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            if (!jsonObj.has("pfNumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "pfNumber not found.");
            } else if (!jsonObj.has("userName")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "userName is required.");
            }else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initial json request : ", ex);
        }
        return jSONObject;
    }
    
    private JSONObject validateResetUserDataRequest(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            if (!jsonObj.has("pfNumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "PF Number is required.");
            } else if (!jsonObj.has("resetpw")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "Reset password is required.");
            }else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initial json request : ", ex);
        }
        return jSONObject;
    }
    
    private JSONObject validateChangeUserPasswordDataRequest(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            if (!jsonObj.has("pfNumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "PF Number is required.");
            } else if (!jsonObj.has("newpassword")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "New password is required.");
            }else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initial json request : ", ex);
        }
        return jSONObject;
    }
    
    private String removeUser(JSONObject formJson) {
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        UserData usr = new UserData();
        try {
            usr.setPfNumber(formJson.getString("pfNumber"));
            usr.setName(formJson.getString("userName"));
            usr.setEnteredIP(formJson.getString("ip"));
            usr.setEnteredHost(formJson.getString("host"));
            usr.setEnteredUser(formJson.getString("user"));
            
                     
            UserRepository repository = new UserRepository();
            resp = repository.removeUserData(usr);
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("UserReference", "USER PF NO");
                jSONObject1.put("errorMessage", "Error in assignUserData.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Load additional JSON data : ", e);
        }

        return resp;
    }
    
    private String resetUser(JSONObject formJson) {
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        UserData usr = new UserData();
        try {
            usr.setPfNumber(formJson.getString("pfNumber"));
            usr.setResetPassword(formJson.getString("resetpw"));
            usr.setEnteredIP(formJson.getString("ip"));
            //usr.setEnteredHost(formJson.getString("host"));
            //usr.setEnteredUser(formJson.getString("user"));
            
            UserRepository repository = new UserRepository();
            resp = repository.resetUserPassword(usr);
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("errorMessage", "Error in Password Reset.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Reset Password : ", e);
        }

        return resp;
    }
    
    private String changeUserPassword(JSONObject formJson) {
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        UserData usr = new UserData();
        try {
            usr.setPfNumber(formJson.getString("pfNumber"));
            usr.setPassword(formJson.getString("newpassword"));
            usr.setEnteredIP(formJson.getString("ip"));
            //usr.setEnteredHost(formJson.getString("host"));
            //usr.setEnteredUser(formJson.getString("user"));
            
            UserRepository repository = new UserRepository();
            resp = repository.changeUserPassword(usr);
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("errorMessage", "Error in Change Password.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Change Password : ", e);
        }

        return resp;
    }
    
    
    public String getSystemUsers() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getSystemUsers();
        } catch (Exception ex) {
            logger.error("Error in get system user data : ", ex);
        }
        return response;
    }
    
    
    public String getDailyAssignments() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getDailyAssignments();
        } catch (Exception ex) {
            logger.error("Error in getDailyAssignments: ", ex);
        }
        return response;
    }
    
    public String getUserLevels() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getUserLevels();
        } catch (Exception ex) {
            logger.error("Error in getUserLevels : ", ex);
        }
        return response;
    } 
    public String getUserAssignmentList() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getUserAssignmentList();
        } catch (Exception ex) {
            logger.error("Error in getCurrencyListWithBalance : ", ex);
        }
        return response;
    }
     public String getTills() {
        UserRepository repository = new UserRepository();
        String response = "";
        try {
            response = repository.getTills();
        } catch (Exception ex) {
            logger.error("Error in getTills : ", ex);
        }
        return response;
    }  
}
