/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;

import com.boc.transfer.model.ITRSInternationalTxn;
import com.boc.transfer.repository.TransactionRepository;
import com.boc.transfer.repository.UserRepository;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.util.Date;
import org.apache.log4j.Logger;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

/**
 *
 * @author it207416
 */
public class TransactionHandler {

    Logger logger = Logger.getLogger(TransactionHandler.class.getName());

    public String getCustomerData(String uinType, String uinNumber) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getCustomerData(uinType, uinNumber);
        } catch (Exception ex) {
            logger.error("Error in get customer data : ", ex);
        }
        return response;
    }

    public String getCurrencyData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getCurrencyData();
        } catch (Exception ex) {
            logger.error("Error in load currencies : ", ex);
        }
        return response;
    }

    public String getExchangeRate(String currency, String shortcode, String txntype) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getExchangeRate(currency, shortcode, txntype);
        } catch (Exception ex) {
            logger.error("Error in get exchange rate : ", ex);
        }
        return response;
    }
    
    public String getITRSCodesforAccounts(String prodcode, String acctype, String natureoftxn) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getITRSCodesDataForAccounts(prodcode, acctype, natureoftxn );
        } catch (Exception ex) {
            logger.error("Error in get exchange rate : ", ex);
        }
        return response;
    }

    public String getCountryData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getCountryData();
        } catch (Exception ex) {
            logger.error("Error in load countries : ", ex);
        }
        return response;
    }

    public String getTransactionCodesData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getTransactionCodesData();
        } catch (Exception ex) {
            logger.error("Error in get transaction codes : ", ex);
        }
        return response;
    }

    public String getITRSCodesData(String txncode) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        JSONObject obj = new JSONObject();
        try {
            response = repository.getITRSCodesData(txncode);
            JSONArray array = new JSONArray(response);
            if (array.length() == 0) {
                obj.put("errorStatus", true);
                obj.put("errorMessage", "No matching data found.");
                return obj.toString();
            }
        } catch (Exception ex) {
            logger.error("Error in get itrs codes : ", ex);
        }
        return response;
    }
    public String getAllITRSCodesData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getAllITRSCodesData();
        } catch (Exception ex) {
            logger.error("Error in get account type codes : ", ex);
        }
        return response;
    }
    public String getAccountTypeCodesData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getAccountTypeCodesData();
        } catch (Exception ex) {
            logger.error("Error in get account type codes : ", ex);
        }
        return response;
    }

    public String getTransactionSectorCodesData(String uintype) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getTransactionSectorCodesData(uintype);
        } catch (Exception ex) {
            logger.error("Error in get Transaction Sector codes : ", ex);
        }
        return response;
    }
    
     public String getTransactions(String txnType, String tillID) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getTransactions(txnType, tillID);
        } catch (Exception ex) {
            logger.error("Error in get Transactions data : ", ex);
        }
        return response;
    }
     public String getTransactionExceptions(String tillID) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getTransactionExceptions(tillID);
        } catch (Exception ex) {
            logger.error("Error in get Transactions data : ", ex);
        }
        return response;
    }
    public String getBankCodesData() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getBankCodesData();
        } catch (Exception ex) {
            logger.error("Error in get Bank codes : ", ex);
        }
        return response;
    }

    public String getRemmitanceData(JSONObject wrkRemJson) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getRemmitanceData(wrkRemJson);
        } catch (Exception ex) {
            logger.error("Error in get Remittance data : ", ex);
        }
        return response;
    }
    
    public String getAccountData(String accnumber) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getAccountData(accnumber);
        } catch (Exception ex) {
            logger.error("Error in get Account data : ", ex);
        }
        return response;
    }
    
    public String getBRefNumber(String bref) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getBRefNumber(bref);
        } catch (Exception ex) {
            logger.error("Error in get BRef rate : ", ex);
        }
        return response;
    }
    
    public String getExchangeReceiptNumber(String receiptNumber) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getExchangeReceiptNumber(receiptNumber);
        } catch (Exception ex) {
            logger.error("Error in get receiptNumber : ", ex);
        }
        return response;
    }
    
    private String getCurrentTimeStamp() {
        SimpleDateFormat sdfDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        Date now = new Date();
        String strDate = sdfDate.format(now);
        return strDate;
    }
    
    public String insertData(JSONObject jSONObject) {
  
        logger.debug("04_INIT_INSERTDATA_HANDLER"+ getCurrentTimeStamp());
        JSONObject validateRequest;
        String response = "";
        validateRequest = validateInsertDataRequest(jSONObject);
        logger.debug("05_VALIDATE_INSERTDATA_HANDLER"+ getCurrentTimeStamp());
        try {
            if ((boolean) validateRequest.get("errorStatus") == true) {
                return validateRequest.toString();
            } else {
                response = insert(jSONObject);
            }
        } catch (JSONException ex) {
            logger.error("Error in insert additional data  for RTGS 103 : ", ex);
        }
        return response;
    }
    
    private JSONObject validateInsertDataRequest(JSONObject jsonObj) {
        JSONObject jSONObject = new JSONObject();
        try {
            
            
         //   Integer refundAmount = Integer.parseInt(refund);
         //   String minusRefund = refund.substring(1, 1);
            
            if (!jsonObj.has("uinnumber")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "UIN is required.");
            } else if (!jsonObj.has("itrscode")) {
                jSONObject.put("errorStatus", true);
                jSONObject.put("errorMessage", "ITRS Code is required.");
            } else if (jsonObj.has("refundAmount")) {
                String refund = jsonObj.getString("refundAmount").replaceAll(",", "");
                if (refund.contains("-")){
                    jSONObject.put("errorStatus", true);
                    jSONObject.put("errorMessage", "Invalid Refund Amount");
                } else{
                    jSONObject.put("errorStatus", false);
                    jSONObject.put("errorMessage", "");
                 }               
                
            } else {
                jSONObject.put("errorStatus", false);
                jSONObject.put("errorMessage", "");
            }
        } catch (JSONException ex) {
            logger.error("Error in validate initioal json request : ", ex);
        }
        return jSONObject;
    }
    
    private String insert(JSONObject formJson) {
        
        logger.debug("06_INIT_INSERTDATA_ABC_HANDLER"+ getCurrentTimeStamp());
        String resp = "";
        JSONObject jSONObject1 = new JSONObject();
        ITRSInternationalTxn txn = new ITRSInternationalTxn();
        try {
            txn.setBranchCode(formJson.getString("branchCode"));
            txn.setTransactionType(formJson.getString("txntype"));
            txn.setIpAddress(formJson.getString("ip"));
            txn.setHostname(formJson.getString("mName"));
            txn.setUser(formJson.getString("userId"));
           // String referenceNo = generateReferenceNo(txn.getBranchCode());
            txn.setReferenceNo(formJson.getString("referrence"));
//            txn.setForm12No(formJson.getString("brefnumber"));
            txn.setUinnumber(formJson.getString("uinnumber"));
            txn.setTitle(formJson.getString("title"));
            txn.setFname(formJson.getString("fname"));
            txn.setCustaddr1(formJson.getString("custaddr1"));
//            txn.setCustaddr2(formJson.getString("custaddr2"));
//            txn.setCustaddr3(formJson.getString("custaddr3"));
//            txn.setPassportNo(formJson.getString("passportno"));
            txn.setBenename(formJson.getString("benename"));
 //           txn.setUserTill(formJson.getString("userTill"));
            
            if (formJson.has("remarks") && !formJson.getString("remarks").equals("")) {
                txn.setRemarks(formJson.getString("remarks"));
            } else {
                txn.setRemarks(" ");
            }
            
            if (formJson.has("previousReceiptNo") && !formJson.getString("previousReceiptNo").equals("")) {
                txn.setPreviousReceiptNo(formJson.getString("previousReceiptNo"));
            } else {
                txn.setPreviousReceiptNo(" ");
            }
            
            if (formJson.has("userTill") && !formJson.getString("userTill").equals("")) {
                txn.setUserTill(formJson.getString("userTill"));
            } else {
                txn.setUserTill("0");
            }
            
            if (formJson.has("benebank") && formJson.getString("benebank").equals("7010 - Bank of Ceylon")) {
                txn.setBenebank("7010");
            } else {
                txn.setBenebank(formJson.getString("benebank")); 
            }
              
            if (formJson.has("natureOfTxnCode") && !formJson.getString("natureOfTxnCode").equals("")) {
                txn.setNatureOfTxnCode(formJson.getString("natureOfTxnCode"));
                if("1".equals(formJson.getString("natureOfTxnCode")) || "2".equals(formJson.getString("natureOfTxnCode")) ) {
                    txn.setAccountNo("0");
                }
            } else {
                txn.setNatureOfTxnCode("0");
            }
            
            if (formJson.has("account") && !formJson.getString("account").equals("")) {
                txn.setAccountNo(formJson.getString("account"));
            } else {
                txn.setAccountNo("0");
            }
            
            if (formJson.has("uincode") && !formJson.getString("uincode").equals("")) {
                txn.setUincode(formJson.getString("uincode"));
            } else {
                txn.setUincode("0");
            }

            if (formJson.has("itrscode") && !formJson.getString("itrscode").equals("")) {
                txn.setItrscode(formJson.getString("itrscode"));
            } else {
                txn.setItrscode("0");
            }
            
            if (formJson.has("sectorcode") && !formJson.getString("sectorcode").equals("")) {
                txn.setSectorcode(formJson.getString("sectorcode"));
            } else {
                txn.setSectorcode("0");
            }
            
            if (formJson.has("accounttypecode") && !formJson.getString("accounttypecode").equals("")) {
                txn.setAccounttypecode(formJson.getString("accounttypecode"));
            } else {
                txn.setAccounttypecode("0");
            }
            
            if (formJson.has("majorcountry") && !formJson.getString("majorcountry").equals("")) {
                txn.setMajorcountry(formJson.getString("majorcountry"));
            } else {
                txn.setMajorcountry("0");
            }
            
            if (formJson.has("majorcountry") && !formJson.getString("majorcountry").equals("")) {
                txn.setMajorcountry(formJson.getString("majorcountry"));
            } else {
                txn.setMajorcountry("0");
            }
            
            if (formJson.has("icurrencyselector1") && !formJson.getString("icurrencyselector1").equals("")) {
                txn.setIcurrencyselector1(formJson.getString("icurrencyselector1"));
            } else {
                txn.setIcurrencyselector1("0");
            }
            
            if (formJson.has("icurrencyselector2") && !formJson.getString("icurrencyselector2").equals("")) {
                txn.setIcurrencyselector2(formJson.getString("icurrencyselector2"));
            } else {
                txn.setIcurrencyselector2("0");
            }
            
            if (formJson.has("icurrencyselector3") && !formJson.getString("icurrencyselector3").equals("")) {
                txn.setIcurrencyselector3(formJson.getString("icurrencyselector3"));
            } else {
                txn.setIcurrencyselector3("0");
            }
            
            if (formJson.has("icurrencyselector4") && !formJson.getString("icurrencyselector4").equals("")) {
                txn.setIcurrencyselector4(formJson.getString("icurrencyselector4"));
            } else {
                txn.setIcurrencyselector4("0");
            }
            
            if (formJson.has("tamount1") && !formJson.getString("tamount1").equals("")) {
                txn.setTamount1(formJson.getString("tamount1"));
            } else {
                txn.setTamount1("0");
            }
            
            if (formJson.has("tamount2") && !formJson.getString("tamount2").equals("")) {
                txn.setTamount2(formJson.getString("tamount2"));
            } else {
                txn.setTamount2("0");
            }
            
            if (formJson.has("tamount3") && !formJson.getString("tamount3").equals("")) {
                txn.setTamount3(formJson.getString("tamount3"));
            } else {
                txn.setTamount3("0");
            }
            
            if (formJson.has("tamount4") && !formJson.getString("tamount4").equals("")) {
                txn.setTamount4(formJson.getString("tamount4"));
            } else {
                txn.setTamount4("0");
            }
            
            if (formJson.has("rate1") && !formJson.getString("rate1").equals("")) {
                txn.setRate1(formJson.getString("rate1"));
            } else {
                txn.setRate1("0");
            }
            
            if (formJson.has("rate2") && !formJson.getString("rate2").equals("")) {
                txn.setRate2(formJson.getString("rate2"));
            } else {
                txn.setRate2("0");
            }
            
            if (formJson.has("rate3") && !formJson.getString("rate3").equals("")) {
                txn.setRate3(formJson.getString("rate3"));
            } else {
                txn.setRate3("0");
            }
            
            if (formJson.has("rate4") && !formJson.getString("rate4").equals("")) {
                txn.setRate4(formJson.getString("rate4"));
            } else {
                txn.setRate4("0");
            }
            ///////added 11/04/2023
            if (formJson.has("defaultRate1") && !formJson.getString("defaultRate1").equals("")) {
                txn.setDefaultRate1(formJson.getString("defaultRate1"));
            } else {
                txn.setDefaultRate1("0");
            }
             if (formJson.has("defaultRate2") && !formJson.getString("defaultRate2").equals("")) {
                txn.setDefaultRate2(formJson.getString("defaultRate2"));
            } else {
                txn.setDefaultRate2("0");
            }
            
               if (formJson.has("defaultRate3") && !formJson.getString("defaultRate3").equals("")) {
                txn.setDefaultRate3(formJson.getString("defaultRate3"));
            } else {
                txn.setDefaultRate3("0");
            }
               
                 if (formJson.has("defaultRate4") && !formJson.getString("defaultRate4").equals("")) {
                txn.setDefaultRate4(formJson.getString("defaultRate4"));
            } else {
                txn.setDefaultRate4("0");
            }
            ///////////added 11/04/2023
            if (formJson.has("camount1") && !formJson.getString("camount1").equals("")) {
                txn.setCamount1(formJson.getString("camount1"));
            } else {
                txn.setCamount1("0");
            }
            
            if (formJson.has("camount2") && !formJson.getString("camount2").equals("")) {
                txn.setCamount2(formJson.getString("camount2"));
            } else {
                txn.setCamount2("0");
            }
            
            if (formJson.has("camount3") && !formJson.getString("camount3").equals("")) {
                txn.setCamount3(formJson.getString("camount3"));
            } else {
                txn.setCamount3("0");
            }
            
            if (formJson.has("camount4") && !formJson.getString("camount4").equals("")) {
                txn.setCamount4(formJson.getString("camount4"));
            } else {
                txn.setCamount4("0");
            }
            
            if (formJson.has("iamount1") && !formJson.getString("iamount1").equals("")) {
                txn.setIncentiveAmount1(formJson.getString("iamount1"));
            } else {
                txn.setIncentiveAmount1("0");
            }
            if (formJson.has("iamount2") && !formJson.getString("iamount2").equals("")) {
                txn.setIncentiveAmount2(formJson.getString("iamount2"));
            } else {
                txn.setIncentiveAmount2("0");
            }
            if (formJson.has("iamount3") && !formJson.getString("iamount3").equals("")) {
                txn.setIncentiveAmount3(formJson.getString("iamount3"));
            } else {
                txn.setIncentiveAmount3("0");
            }
            if (formJson.has("iamount4") && !formJson.getString("iamount4").equals("")) {
                txn.setIncentiveAmount4(formJson.getString("iamount4"));
            } else {
                txn.setIncentiveAmount4("0");
            }
            
            if (formJson.has("usdCrossRate1") && !formJson.getString("usdCrossRate1").equals("")) {
                txn.setUsdCrossRate1(formJson.getString("usdCrossRate1"));
            } else {
                txn.setUsdCrossRate1("0");
            }
            
            if (formJson.has("usdCrossRate2") && !formJson.getString("usdCrossRate2").equals("")) {
                txn.setUsdCrossRate2(formJson.getString("usdCrossRate2"));
            } else {
                txn.setUsdCrossRate2("0");
            }
            
            if (formJson.has("usdCrossRate3") && !formJson.getString("usdCrossRate3").equals("")) {
                txn.setUsdCrossRate3(formJson.getString("usdCrossRate3"));
            } else {
                txn.setUsdCrossRate3("0");
            }
            
            if (formJson.has("usdCrossRate4") && !formJson.getString("usdCrossRate4").equals("")) {
                txn.setUsdCrossRate4(formJson.getString("usdCrossRate4"));
            } else {
                txn.setUsdCrossRate4("0");
            }
            
            if (formJson.has("usdEqvAmount1") && !formJson.getString("usdEqvAmount1").equals("")) {
                txn.setUsdEqvAmount1(formJson.getString("usdEqvAmount1"));
            } else {
                txn.setUsdEqvAmount1("0");
            }
                        
            if (formJson.has("usdEqvAmount2") && !formJson.getString("usdEqvAmount2").equals("")) {
                txn.setUsdEqvAmount2(formJson.getString("usdEqvAmount2"));
            } else {
                txn.setUsdEqvAmount2("0");
            }
            
            if (formJson.has("usdEqvAmount3") && !formJson.getString("usdEqvAmount3").equals("")) {
                txn.setUsdEqvAmount3(formJson.getString("usdEqvAmount3"));
            } else {
                txn.setUsdEqvAmount3("0");
            }
                
            if (formJson.has("usdEqvAmount4") && !formJson.getString("usdEqvAmount4").equals("")) {
                txn.setUsdEqvAmount4(formJson.getString("usdEqvAmount4"));
            } else {
                txn.setUsdEqvAmount4("0");
            }
            if (formJson.has("commisionAmount") && !formJson.getString("commisionAmount").equals("")) {
                txn.setCommissionAmount(formJson.getString("commisionAmount"));
            } else {
                txn.setCommissionAmount("0");
            }
            
            if (formJson.has("commisionpercentage") && !formJson.getString("commisionpercentage").equals("")) {
                txn.setCommissionPercentage(formJson.getString("commisionpercentage"));
            } else {
                txn.setCommissionPercentage("0");
            }
            if (formJson.has("lkrtotal") && !formJson.getString("lkrtotal").equals("")) {
                txn.setTotalLKR(formJson.getString("lkrtotal"));
            } else {
                txn.setTotalLKR("0");
            }
            
            if (formJson.has("inctotal") && !formJson.getString("inctotal").equals("")) {
                txn.setTotalIncentive(formJson.getString("inctotal"));
            } else {
                txn.setTotalIncentive("0");
            }
            
            if (formJson.has("ceilingFloorComm") && !formJson.getString("ceilingFloorComm").equals("")) {
                txn.setCeilingOrFloorCommission(formJson.getString("ceilingFloorComm"));
            } else {
                txn.setCeilingOrFloorCommission("0");
            }
            
            if (formJson.has("custotal") && !formJson.getString("custotal").equals("")) {
                txn.setTotalToCustomer(formJson.getString("custotal"));
            } else {
                txn.setTotalToCustomer("0");
            }
            
            if (formJson.has("receivedAmount") && !formJson.getString("receivedAmount").equals("")) {
                txn.setReceivedAmount(formJson.getString("receivedAmount"));
            } else {
                txn.setReceivedAmount("0");
            }
            
            if (formJson.has("refundAmount") && !formJson.getString("refundAmount").equals("")) {
               // String refundAmount = formJson.getString("refundAmount").replaceAll(",", "");
                txn.setRefundAmount(formJson.getString("refundAmount").replaceAll(",", ""));
            } else {
                txn.setRefundAmount("0");
            }
            
                
            if (formJson.has("benecountry") && !formJson.getString("benecountry").equals("")) {
                txn.setBenecountry(formJson.getString("benecountry"));
            } else {
                txn.setBenecountry("0");
            }  
            
            if (formJson.has("airTicketNo") && !formJson.getString("airTicketNo").equals("")) {
                txn.setAirTicketNo(formJson.getString("airTicketNo"));
            } else {
                txn.setAirTicketNo("0");
            } 
                     
            TransactionRepository repository = new TransactionRepository();
            resp = repository.insertData(txn);
            
            logger.debug("09_END_INSERTDATA_ABC_HANDLER"+ getCurrentTimeStamp());
            
        } catch (Exception e) {
            try {
                jSONObject1.put("errorStatus", true);
                jSONObject1.put("bankReference", "REFERENCE NO");
                jSONObject1.put("errorMessage", "Error in save data.");
                return jSONObject1.toString();
            } catch (JSONException ex) {
                logger.error(ex);
            }
            logger.error("Error in Load additional JSON data : ", e);
        }

        return resp;
    }
    
    
    
    public String getTransactionData(String txnRefNo) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getTransactionData(txnRefNo);
        } catch (Exception ex) {
            logger.error("Error in get Transaction Data : ", ex);
        }
        return response;
    }
    
    
    
    private String generateReferenceNo(String branchCode){
        TransactionRepository repository = new TransactionRepository();
        String date = getDateFormatted().substring(2, 8);
        String date2 = getDateFormatted();     
        String sequenceNum = repository.getMaxReferenceSequence(date2);
        String branch = ("00000" + branchCode).substring(branchCode.length());
        return date + branch + sequenceNum;
    }
    
    private String getDateFormatted() {
        DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyyMMdd");
        LocalDate localDate = LocalDate.now();
        return dtf.format(localDate);
    }
    
    
    
    public String calculateCommission(String txnType, String passHolType, String amount) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.calculateCommission(txnType, passHolType, amount);
        } catch (Exception ex) {
            logger.error("Error in get Account data : ", ex);
        }
        return response;
    }
    

       

    
    public String approveCancelTransaction(String txnRef, String user, String reason, String ip, String hostname) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.approveCancelTransaction(txnRef, user, reason, ip, hostname);
        } catch (Exception ex) {
            logger.error("Error in get Account data : ", ex);
        }
        return response;
    }
    
     public String rejectCancelTransaction(String txnRef, String user, String reason, String ip, String hostname) {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.rejectCancelTransaction(txnRef, user, reason, ip, hostname);
        } catch (Exception ex) {
            logger.error("Error in get Account data : ", ex);
        }
        return response;
    }
       
       
    
       
    public String changeTransactionState(String txnRef, String user, String reason, String ip, String hostname) {
        String resp = "";
        boolean errorStatus = true;   
        JSONObject resultJson = new JSONObject();
        try {
            TransactionRepository repository = new TransactionRepository();
            resp = repository.changeTransactionState(txnRef, user, reason, ip, hostname);
            if (resp=="true") {               
                errorStatus = false;
                resultJson.put("errorStatus", false);
                resultJson.put("dealReference", txnRef);
                resultJson.put("errorMessage", "");
            } else if (resp=="false") {
                errorStatus = true;
                resultJson.put("errorStatus", true);
                resultJson.put("bankReference", "");
                resultJson.put("errorMessage", "Error in cancel transaction.");
            } else if (resp=="insufficient") {
                errorStatus = true;
                resultJson.put("errorStatus", true);
                resultJson.put("bankReference", "");
                resultJson.put("errorMessage", "Till amount is insufficient to cancel the transaction.");
            }
        } catch (Exception e) {
            logger.error("Error in getBasicData : ", e);
        }
        return resultJson.toString();
    }
     
        public String getPendingCancellationList() {
        TransactionRepository repository = new TransactionRepository();
        String response = "";
        try {
            response = repository.getPendingCancellationList();
        } catch (Exception ex) {
            logger.error("Error in load currencies : ", ex);
        }
        return response;
    }

    
}
    

    

