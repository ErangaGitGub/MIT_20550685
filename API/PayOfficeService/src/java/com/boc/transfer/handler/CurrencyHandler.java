/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;
import com.boc.transfer.model.UserData;
import com.boc.transfer.model.ChequeDeposit;
import com.boc.transfer.repository.UserRepository;
import com.boc.transfer.repository.CurrencyRepository;
import org.apache.log4j.Logger;
import org.json.JSONException;
import org.json.JSONObject;
/**
 *
 * @author it203886
 */
public class CurrencyHandler {
    Logger logger = Logger.getLogger(VaultHandler.class.getName());
    

       
    public String insertCurrency(String formJson) {
        CurrencyRepository repository = new CurrencyRepository();
        String response = "";
        try {
            response = repository.insertCurrency(formJson);
        } catch (Exception ex) {
            logger.error("Error in insertCurrency : ", ex);
        }
        return response;
    }
    
        public String insertChequeData(JSONObject jSONObject) {
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateInsertChequeData(jSONObject);
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = insertCheque(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in insert additional data  for RTGS 103 : ", ex);
        }
        return response;
    }
        
    private JSONObject validateInsertChequeData(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            if (!jsonObj.has("accountnumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "accountnumber is required.");
            } else if (!jsonObj.has("customername")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "customername is required.");
            } else if (!jsonObj.has("debitbankcode")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "debitbankcode is required.");
            }else if (!jsonObj.has("debitbranchcode")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "debitbranchcode is required.");
            }
            else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initioal json request : ", ex);
        }
        return jSONObject;
    }
        
    private String insertCheque(JSONObject formJson) {
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        ChequeDeposit chq = new ChequeDeposit();
        try {
            chq.setReference(formJson.getString("reference"));
            chq.setAccount(formJson.getString("accountnumber"));
            chq.setCustomername(formJson.getString("customername"));
            chq.setBankcode(formJson.getString("debitbankcode"));
            chq.setBranchcode(formJson.getString("debitbranchcode"));
            chq.setAmount(formJson.getString("amount"));
            chq.setUser(formJson.getString("userId"));
            chq.setIpAddress(formJson.getString("ip"));
            chq.setHostname(formJson.getString("mName"));
//             
                     
            CurrencyRepository repository = new CurrencyRepository();
            resp = repository.insertChequeData(chq);
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("bankReference", "REFERENCE NO");
                jSONObject1.put("errorMessage", "Error in save cheque deposit data.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Load additional JSON data : ", e);
        }

        return resp;
    }
    
    public String getRatesData(String printType) {
        CurrencyRepository repository = new CurrencyRepository();
        String response = "";
        try {
            response = repository.getRatesData(printType);
        } catch (Exception ex) {
            logger.error("Error in getRatesData : ", ex);
        }
        return response;
    }
    
    public String getChequeData() {
        CurrencyRepository repository = new CurrencyRepository();
        String response = "";
        try {
            response = repository.getChequeData();
        } catch (Exception ex) {
            logger.error("Error in getChequeData : ", ex);
        }
        return response;
    }
    
    public String authorizeRejectCurrency(String formJson) {
        CurrencyRepository repository = new CurrencyRepository();
        String response = "";
        try {
            response = repository.authorizeRejectCurrency(formJson);
        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
}
