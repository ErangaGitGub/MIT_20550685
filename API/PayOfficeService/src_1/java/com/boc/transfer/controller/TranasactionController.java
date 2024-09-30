/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import com.boc.transfer.handler.TransactionHandler;
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
@Path("txn")
public class TranasactionController {
    
    Logger logger = Logger.getLogger(TranasactionController.class.getName());
    
   @POST
    @Path("getCustomerData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCustomerData(@HeaderParam("apiKey") String key, String uinJson) {
        logger.debug("getCustomerData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String customerData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(uinJson);
                if (!jsonObj.has("uinType")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "UIN Type is required.");
                    return jSONObject.toString();
                }
                else if (!jsonObj.has("uinNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "UIN Number is required.");
                    return jSONObject.toString();
                }else{
                    TransactionHandler handler = new TransactionHandler();
                    customerData = handler.getCustomerData(jsonObj.getString("uinType"),jsonObj.getString("uinNumber").toUpperCase());
                }               
            }
        } catch (Exception ex) {
            logger.warn("Error in getCustomerData", ex);
        }
        return customerData;
    }
    
    
    @POST
    @Path("getCurrencyData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCurrencyData(@HeaderParam("apiKey") String key) {
        logger.debug("getCurrencyData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String currencyData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                currencyData = handler.getCurrencyData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getCurrencyData", ex);
        }
        return currencyData;
    }
      
    
    @POST
    @Path("getExchangeRate/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getExchangeRate(@HeaderParam("apiKey") String key, String currencyJson) {
        logger.debug("getExchangeRate");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String exchangeRate = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(currencyJson);
                if (!jsonObj.has("currency")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Curreny is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("txntype")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Transaction Type is required.");
                    return jSONObject.toString();
                } else if (!jsonObj.has("shortcode")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "shortcode  is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    exchangeRate = handler.getExchangeRate(jsonObj.getString("currency"),jsonObj.getString("shortcode"), jsonObj.getString("txntype"));
                }               
            }
        } catch (Exception ex) {
            logger.warn("Error in getExchangeRate", ex);
        }
        return exchangeRate;
    }
    
        
    @POST
    @Path("getCountryData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getCountryList(@HeaderParam("apiKey") String key) {
        logger.debug("getCountryData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String countryList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                countryList = handler.getCountryData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getCountryData", ex);
        }
        return countryList;
    }
    
    
    @POST
    @Path("getTransactionCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTransactionCodesData(@HeaderParam("apiKey") String key) {
        logger.debug("getTransactionCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String TransactionCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                TransactionCodesList = handler.getTransactionCodesData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getTransactionCodesData", ex);
        }
        return TransactionCodesList;
    }
    
    
    @POST
    @Path("getITRSCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getITRSCodesData(@HeaderParam("apiKey") String key, String txntypeJson) {
        logger.debug("getITRSCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String ITRSCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(txntypeJson);
                if (!jsonObj.has("txncode")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Nature of Transaction is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    ITRSCodesList = handler.getITRSCodesData(jsonObj.getString("txncode"));
                } 
            }
        } catch (Exception ex) {
            logger.warn("Error in getITRSCodesData", ex);
        }
        return ITRSCodesList;
    }
    @POST
    @Path("getAllITRSCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getAllITRSCodesData(@HeaderParam("apiKey") String key) {
        logger.debug("getAllITRSCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String AllITRSCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                AllITRSCodesList = handler.getAllITRSCodesData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getAccountTypeCodesData", ex);
        }
        return AllITRSCodesList;
    }
    
    @POST
    @Path("getAccountTypeCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getAccountTypeCodesData(@HeaderParam("apiKey") String key) {
        logger.debug("getAccountTypeCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String AccountTypeCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                AccountTypeCodesList = handler.getAccountTypeCodesData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getAccountTypeCodesData", ex);
        }
        return AccountTypeCodesList;
    }
    
    @POST
    @Path("getTransactions/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTransactions(@HeaderParam("apiKey") String key, String txnTypeJson) {
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
                JSONObject jsonObj = new JSONObject(txnTypeJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Till ID is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("txnType")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Txn Type is required.");
                    return jSONObject.toString();
                }else {   
                TransactionHandler handler = new TransactionHandler();
                response = handler.getTransactions(jsonObj.getString("txnType"), jsonObj.getString("tillID"));
               
                    if (response.length() <= 2) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Records not found.");
                        jSONArray.put(jSONObject);
                        response = jSONArray.toString();
                    }
                }
            }
        } catch (Exception e) {
            logger.error("Error in loadBasicData : ", e);
        }
        return response;
    }
    
    @POST
    @Path("getTransactionExceptions/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTransactionExceptions(@HeaderParam("apiKey") String key, String tillJson) {
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
                JSONObject jsonObj = new JSONObject(tillJson);
                if (!jsonObj.has("tillID")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Till ID is required.");
                    return jSONObject.toString();
                }else {   
                TransactionHandler handler = new TransactionHandler();
                response = handler.getTransactionExceptions(jsonObj.getString("tillID"));
               
                    if (response.length() <= 2) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Records not found.");
                        jSONArray.put(jSONObject);
                        response = jSONArray.toString();
                    }
                }
            }
        } catch (Exception e) {
            logger.error("Error in loadBasicData : ", e);
        }
        return response;
    }
    

    @POST
    @Path("getTransactionSectorCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTransactionSectorCodesData(@HeaderParam("apiKey") String key, String uintypeJson) {
        logger.debug("getTransactionSectorCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String TransactionSectorCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(uintypeJson);
                if (!jsonObj.has("uintype")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "UIN Type is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    TransactionSectorCodesList = handler.getTransactionSectorCodesData(jsonObj.getString("uintype"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in getTransactionSectorCodesData", ex);
        }
        return TransactionSectorCodesList;
    }
    
    
    @POST
    @Path("getBankCodesData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getBankCodesData(@HeaderParam("apiKey") String key) {
        logger.debug("getBankCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String BankCodesList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                TransactionHandler handler = new TransactionHandler();
                BankCodesList = handler.getBankCodesData();
            }
        } catch (Exception ex) {
            logger.warn("Error in getBankCodesData", ex);
        }
        return BankCodesList;
    }
    
     @POST
    @Path("getITRSCodesforAccounts/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getITRSCodesforAccounts(@HeaderParam("apiKey") String key, String accITRSJson) {
        logger.debug("getITRSCodesforAccounts");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String itrsCodesAccList = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(accITRSJson);
                if (!jsonObj.has("prodcode")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Product Code is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("acctype")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Account Type is required.");
                    return jSONObject.toString();
                } else{
                TransactionHandler handler = new TransactionHandler();
                itrsCodesAccList = handler.getITRSCodesforAccounts(jsonObj.getString("prodcode"),jsonObj.getString("acctype"), jsonObj.getString("natureoftxn"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in getBankCodesData", ex);
        }
        return itrsCodesAccList;
   }

    
    @POST
    @Path("getRemmitanceData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getRemmitanceData(@HeaderParam("apiKey") String key, String incentiveJson) {
        logger.debug("getBankCodesData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String wrkRemData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(incentiveJson);
                TransactionHandler handler = new TransactionHandler();
                wrkRemData = handler.getRemmitanceData(jsonObj);
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getBankCodesData", ex);
        }
        return wrkRemData;
    }
    
    
    @POST
    @Path("getAccountData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getAccountData(@HeaderParam("apiKey") String key, String accountJson) {
        logger.debug("getAccountData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String accountData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(accountJson);
                if (!jsonObj.has("accountnumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Account Number is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    accountData = handler.getAccountData(jsonObj.getString("accountnumber"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in getAccountData", ex);
        }
        return accountData;
    }
    
      private String getCurrentTimeStamp() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }
    
    
    @POST
    @Path("insertData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String insertData(@HeaderParam("apiKey") String key, String formJson) {
        logger.debug("01_INIT_INSERTDATA_CONTROLLER"+ getCurrentTimeStamp());
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String response = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                logger.debug("02_INIT_AUTHUSER_CONTROLLER"+ getCurrentTimeStamp());
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                logger.debug("02_INIT_AUTHUSER_CONTROLLER"+ getCurrentTimeStamp());
                JSONObject jsonObj = new JSONObject(formJson);
                if (!jsonObj.has("uinnumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "UIN No is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("itrscode")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "ITRS CODE is required.");
                    return jSONObject.toString();
                }else if (!jsonObj.has("userTill")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "User Till is required.");
                    return jSONObject.toString();
                } else{
                    logger.debug("03_INIT_CALLTXNHANDLER_CONTROLLER"+ getCurrentTimeStamp());
                    TransactionHandler handler = new TransactionHandler();
                    response = handler.insertData(jsonObj);
                    logger.debug("10_END_CALLTXNHANDLER_CONTROLLER"+ getCurrentTimeStamp());
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in insertData", ex);
        }
        return response;
    }
    
    @POST
    @Path("getTransactionData/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getTransactionData(@HeaderParam("apiKey") String key, String txnRefJson) {
        logger.debug("getTransactionData");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String TransactionData = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(txnRefJson);
                if (!jsonObj.has("txnRef")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Transaction Reference Number is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    TransactionData = handler.getTransactionData(jsonObj.getString("txnRef"));
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in getTransactionSectorCodesData", ex);
        }
        return TransactionData;
    }
    
  
    
    @POST
    @Path("getBRefNumber/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getBRefNumber(@HeaderParam("apiKey") String key, String brefJson) {
        logger.debug("getBRefNumber");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String bRef = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(brefJson);
                if (!jsonObj.has("bref")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "bref is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    bRef = handler.getBRefNumber(jsonObj.getString("bref"));
                }               
            }
        } catch (Exception ex) {
            logger.warn("Error in getBRefNumber", ex);
        }
        return bRef;
    }
    
    @POST
    @Path("getExchangeReceiptNumber/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getExchangeReceiptNumber(@HeaderParam("apiKey") String key, String receiptJson) {
        logger.debug("getExchangeReceiptNumber");
        ApiAuthontication authontication = new ApiAuthontication();
        JSONObject jSONObject = new JSONObject();
        String receipt = "";
        try {
            if (!authontication.isUserAuthenticated(key)) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "User not authenticated");
                return jSONObject.toString();
            } else {
                JSONObject jsonObj = new JSONObject(receiptJson);
                if (!jsonObj.has("receiptNumber")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Receipt Number is required.");
                    return jSONObject.toString();
                } else{
                    TransactionHandler handler = new TransactionHandler();
                    receipt = handler.getExchangeReceiptNumber(jsonObj.getString("receiptNumber"));
                }               
            }
        } catch (Exception ex) {
            logger.warn("Error in getExchangeReceiptNumber", ex);
        }
        return receipt;
    }
    
    
    
@POST
    @Path("CalculateCommission/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String CalculateCommission(@HeaderParam("apiKey") String key, String tillJson) {
        logger.debug("CalculateCommission");
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
                if (!jsonObj.has("txnType")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Transaction type is required.");
                    return jSONObject.toString();
                    } else if (!jsonObj.has("passHolType")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Passport type  is required.");
                    return jSONObject.toString();
                    } else if (!jsonObj.has("amount")) {
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Amount  is required.");
                    return jSONObject.toString();
                }else{
                    TransactionHandler handler = new TransactionHandler();
                    response = handler.calculateCommission(jsonObj.getString("txnType"), jsonObj.getString("passHolType"), jsonObj.getString("amount"));
                }
                
            }
        } catch (Exception ex) {
            logger.warn("Error in getPendingTransfers", ex);
        }
        return response;
    }
    

    
    @POST
    @Path("approveCancelTransaction/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String approveCancelTransaction(@HeaderParam("apiKey") String key, String dataJson) {
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
                JSONObject jsonObj = new JSONObject(dataJson);
                 if (!jsonObj.has("txnRef")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Transaction reference number is required.");
                        return jSONObject.toString();
                 } else {
                    String txnRef = jsonObj.getString("txnRef"); 
                    String user = jsonObj.getString("user"); 
                    String reason = jsonObj.getString("reason");
                    
                    String ip = jsonObj.getString("ip"); 
                    String hostname = jsonObj.getString("hostname"); 
                     
                    TransactionHandler handler = new TransactionHandler();
                    response = handler.approveCancelTransaction(txnRef, user, reason, ip, hostname);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in removeUserData", ex);
        }
        return response;
    }
    
        @POST
    @Path("rejectCancelTransaction/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String rejectCancelTransaction(@HeaderParam("apiKey") String key, String dataJson) {
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
                JSONObject jsonObj = new JSONObject(dataJson);
                 if (!jsonObj.has("txnRef")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Transaction reference number is required.");
                        return jSONObject.toString();
                 } else {
                    String txnRef = jsonObj.getString("txnRef"); 
                    String user = jsonObj.getString("user"); 
                    String reason = jsonObj.getString("reason");
                    
                    String ip = jsonObj.getString("ip"); 
                    String hostname = jsonObj.getString("hostname"); 
                     
                    TransactionHandler handler = new TransactionHandler();
                    response = handler.rejectCancelTransaction(txnRef, user, reason, ip, hostname);
                }
            }
        } catch (Exception ex) {
            logger.warn("Error in removeUserData", ex);
        }
        return response;
    }
    
    @POST
    @Path("changeTransactionState/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String changeTransactionState(@HeaderParam("apiKey") String key, String dataJson) {
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
                 if (!jsonObj.has("txnRef")) {
                        jSONObject.put("errorStatus", true);
                        jSONObject.put("errorMessage", "Transaction reference number is required.");
                        return jSONObject.toString();
                 } else {
                    String txnRef = jsonObj.getString("txnRef"); 
                    String user = jsonObj.getString("user"); 
                    String reason = jsonObj.getString("reason");
                    
                    String ip = jsonObj.getString("ip"); 
                    String hostname = jsonObj.getString("hostname"); 
                     
                    TransactionHandler handler = new TransactionHandler();
                    response = handler.changeTransactionState(txnRef, user, reason, ip, hostname);
                }
            }
        } catch (Exception e) {
            logger.error("Error in verifying Money Market Deal : ", e);
        }
        return response;
    }
    

    
    @POST
    @Path("getPendingCancellationList/")
    @Produces(MediaType.APPLICATION_JSON)
    @Consumes(MediaType.APPLICATION_JSON)
    public String getPendingCancellationList(@HeaderParam("apiKey") String key) {
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
                TransactionHandler handler = new TransactionHandler();
                response = handler.getPendingCancellationList();
               
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
    
    

    
}
