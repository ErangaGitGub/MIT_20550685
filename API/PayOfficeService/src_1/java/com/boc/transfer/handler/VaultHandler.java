/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;


import com.boc.transfer.model.UserData;
import com.boc.transfer.repository.TransactionRepository;
import com.boc.transfer.repository.UserRepository;
import com.boc.transfer.repository.VaultRepository;
import org.apache.log4j.Logger;
import org.json.JSONException;
import org.json.JSONObject;


/**
 *
 * @author it207458
 */
public class VaultHandler {

    Logger logger = Logger.getLogger(VaultHandler.class.getName());
    

       
    public String getCurrencyList() {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getCurrencyList();
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
    public String getPreviousDayOpeningBalance(String tillID) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getPreviousDayOpeningBalance(tillID);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
    public String getCurrencyListWithBalance(String tillID) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getCurrencyListWithBalance(tillID);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyListWithBalance : ", ex);
        }
        return response;
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
    
    public String insertToPOS(String formJson) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.insertToPOS(formJson);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
    public String insertToT4S(String formJson) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.insertToT4S(formJson);
        } catch (Exception ex) {
            logger.error("Error in insertToT4S : ", ex);
        }
        return response;
    }
    
    public String tillToTill(String formJson) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.tillToTill(formJson);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
    public String getTillBalance(String tillID) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getTillBalance(tillID);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyListWithBalance : ", ex);
        }
        return response;
    }
    
    public String getPendingTransfers(String tillID) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getPendingTransfers(tillID);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyListWithBalance : ", ex);
        }
        return response;
    }
    
    public String getCashTransfers(String tillID, String type) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.getCashTransfers(tillID, type);
        } catch (Exception ex) {
            logger.error("Error in getCashTransfers : ", ex);
        }
        return response;
    }
    
    public String acceptRejectAllTransfers(String tillID, String action) {
        VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.acceptRejectAllTransfers(tillID, action);
        } catch (Exception ex) {
            logger.error("Error in acceptRejectAllTransfers : ", ex);
        }
        return response;
    }
    
    public String acceptCashToTill(String sourceTill, String destTill, String curr, String amount, String user, String timestamp, String status) {
       VaultRepository repository = new VaultRepository();
        String response = "";
        try {
            response = repository.acceptCashToTill(sourceTill,destTill, curr, amount,  user,  timestamp,  status);
        } catch (Exception ex) {
            logger.error("Error in get Account data : ", ex);
        }
        return response;
    }
    
    
      
}
