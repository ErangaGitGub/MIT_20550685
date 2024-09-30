/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.handler;

import com.boc.transfer.repository.VaultRepository;
import org.apache.log4j.Logger;
import com.boc.transfer.repository.CommunicatorRepository;
import org.json.JSONException;
/**
 *
 * @author it203886
 */
public class CommunicatorHandler {
    Logger logger = Logger.getLogger(VaultHandler.class.getName());
    public String executeFCITransaction(String fromAcct, String fromAccountType, String toAcct, String toAccountType, String amount,String commission,String descrpt,String txnRef) throws JSONException{
       
        CommunicatorRepository repository = new CommunicatorRepository();
        String response = "";
        try {
         //   response = repository.executeFCITransaction(fromAcct,fromAccountType,toAcct, toAccountType ,amount,commission,descrpt,txnRef);

        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
     public String executePFCTransaction(String fromAcct, String fromAccountType, String toAcct, String toAccountType, String amount,String currency,String descrpt,String txnRef) throws JSONException{
       
        CommunicatorRepository repository = new CommunicatorRepository();
        String response = "";
        try {
         //   response = repository.executePFCTransaction(fromAcct,fromAccountType,toAcct, toAccountType ,amount,currency,descrpt,txnRef);

        } catch (Exception ex) {
            logger.error("Error in getCurrencyList : ", ex);
        }
        return response;
    }
    
    
}
