/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.ibm.as400.access.AS400;
import com.ibm.as400.access.AS400Message;
import com.ibm.as400.access.AS400Text;
import com.ibm.as400.access.CommandCall;
import com.ibm.as400.access.ProgramCall;
import com.ibm.as400.access.ProgramParameter;
import org.apache.log4j.Logger;
import org.json.JSONObject;

/**
 *
 * @author it207664
 */
public class RPGRepository {
    
    Logger logger = Logger.getLogger(DbConnection.class.getName());
    private static String treasuryLibrary;
    public AS400 as400 = null;
    public String executeRPGProgram(String dealOperation, String delRefNo){
        String fullProgramName = "";
        String state = "";
        ProgramParameter[] parmList;
        ProgramCall programCall;
        AS400Text ParamDealID = new AS400Text(10);
        AS400Text ParamState = new AS400Text(1);
        boolean status = false;
        JSONObject jSONObject = new JSONObject();
        GetDataLibrary library = new GetDataLibrary();
       // treasuryLibrary = library.loadTxnLibraty();
        treasuryLibrary = library.loadTxnLibraty();
        switch (dealOperation) {
            case "DayBegin" :
                fullProgramName = "/QSYS.LIB/"+ treasuryLibrary +".LIB/PPYB0073.PGM";
                state = "B";
                break;
            case "DayEnd" :
                fullProgramName = "/QSYS.LIB/"+ treasuryLibrary +".LIB/PPYB0072.PGM";
                state = "E";
                break; 
            case "DayEndPriorCheck" :
                fullProgramName = "/QSYS.LIB/"+ treasuryLibrary +".LIB/PPYB0071.PGM";
                state = "P";
                break;                 
            case "Reports" :
                fullProgramName = "/QSYS.LIB/"+ treasuryLibrary +".LIB/PPYB0021.PGM";
                state = "Rp";
                break;    
        }
        
        try {
            as400 = DbConnection.getAS400();
            programCall = new ProgramCall(as400);
            CommandCall command = new CommandCall(as400);
            
            if("P".equals(state)){
                  parmList = new ProgramParameter[2];
                  parmList[0] = new ProgramParameter(ParamState.toBytes(state),1);
                  parmList[1] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                  programCall.setProgram(fullProgramName, parmList);
               // programCall.setProgram(fullProgramName);
               
            } else if ("E".equals(state)){
                parmList = new ProgramParameter[2];
                parmList[1] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                parmList[0] = new ProgramParameter(ParamState.toBytes(state),1);
                programCall.setProgram(fullProgramName, parmList);
//                 programCall.setProgram(fullProgramName);
            } else if ("B".equals(state)){
                parmList = new ProgramParameter[2];
                parmList[1] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                parmList[0] = new ProgramParameter(ParamState.toBytes(state),1);
                programCall.setProgram(fullProgramName, parmList);
                 // programCall.setProgram(fullProgramName);
                 
            } else if ("Rp".equals(state)){
                parmList = new ProgramParameter[1];
                parmList[0] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                programCall.setProgram(fullProgramName, parmList);
            } else if ("Br".equals(state)){
                parmList = new ProgramParameter[2];
                parmList[0] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                parmList[1] = new ProgramParameter(ParamState.toBytes("B"),1);
                programCall.setProgram(fullProgramName, parmList);
            } else if ("R".equals(state) || "B".equals(state)){
                parmList = new ProgramParameter[2];
                parmList[0] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);
                parmList[1] = new ProgramParameter(ParamState.toBytes(state),1);
                programCall.setProgram(fullProgramName, parmList);
            } else {
                parmList = new ProgramParameter[2];
                parmList[1] = new ProgramParameter(ParamDealID.toBytes(delRefNo),10);//User will be DealRefNo
                parmList[0] = new ProgramParameter(ParamState.toBytes(state),1);
                programCall.setProgram(fullProgramName, parmList);
            }
            
           if (!programCall.run()) {
                AS400Message[] messageList = programCall.getMessageList();
                for (AS400Message message : messageList) {
                    System.out.println(message.getID() + " - " + message.getText());
                }
            } else {
                System.out.println("Program Called");
            }
        } catch(Exception Ex) {
            logger.error("Error get user basic data : ", Ex);
        } finally {
             try {
                // Make sure to disconnect 
                if (as400 != null) {
                    as400.disconnectAllServices();
                }
            } catch (Exception Ex) {
                logger.error("Error get user basic data : ", Ex);
            }
        }
        return jSONObject.toString();
       //return status;
    }
}
 