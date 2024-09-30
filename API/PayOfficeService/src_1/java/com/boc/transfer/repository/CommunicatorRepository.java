/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import java.io.ByteArrayInputStream;
import java.io.IOException;
import java.util.UUID;
import java.util.concurrent.TimeUnit;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import org.apache.http.HttpResponse;
import org.apache.http.ParseException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.config.RequestConfig;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.ByteArrayEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONObject;
import org.w3c.dom.DOMException;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;
import com.boc.transfer.repository.VaultRepository;
import java.text.SimpleDateFormat;
import org.json.JSONException;
import com.boc.transfer.repository.TransactionRepository;
import com.boc.transfer.repository.WriteFile;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Arrays;
import java.util.Calendar;
//////
////////
/**
 *
 * @author it203886
 */
public class CommunicatorRepository {

    org.apache.log4j.Logger logger = org.apache.log4j.Logger.getLogger(VaultRepository.class.getName());
    private static final String XML_DECLARE = "<?xml version=\"1.0\"?> \r\n";
    private static String environmrnt, dataLibrary, txnLibrary, operatorLevel, bClassLevel, aClassLevel, dealer;

    private String header, middle1, middle2, middle3, middle4, middle5, middle6, middle7, middle8, middle9, middle10, footer, txnRqXml;
    private String uuid;
    private HttpClient client;
    private HttpResponse response;
    private HttpPost post;
    private ByteArrayEntity entity;
    private String result;
    private DocumentBuilderFactory dbFactory;
    private DocumentBuilder dBuilder;
    private Document doc;
    private NodeList nList1, nList2, nList3;
    private Node nNode1, nNode2, nNode3;
    private Element eElement1, eElement2, eElement3;
    private String[] results;
    private String StatusCode;
    private String Desc;
    private String ErrNum;
    private String hostRefNo;

    private String SignonRole;// = "CSR";
    private String SPName;// = "FiservICBS";
    private String CustLoginId;// = "SGINTNET";
    private String comPswd;// = "sg78@789";
    private String ComputerId;// = "SGPVMAPRDEV03";
    private String InstitutionCode;// = "BOCSR";
    private String ClientAppName;// = "EPAY";
    private String ComUrl;//UAT="https://hofiservcom01.bankofceylon.local/CRG_PRODUAT/crg.aspx";
    private String branch;
    private String teller;
    private String costcenter;
    private String trnc;

    private int CONNECTION_TIMEOUT_MS;// = 40000; // Timeout in millis.

    String[] arr1;
     VaultRepository vr  = new VaultRepository();
 //JSONObject js = new JSONObject(vr.getCurrentDateTime());
 //String efDate = js.getString("date");
     String efDate = "";
 String timeStamp = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
 JSONObject jSONObject = new JSONObject();

    public CommunicatorRepository() throws JSONException {
        // Property values


        try {
            GetDataLibrary library = new GetDataLibrary();

            SignonRole = library.loadSignonRole();
            SPName = library.loadSPName();
            CustLoginId = library.loadCustLoginId();
            comPswd = library.loadcomPswd();
            ComputerId = library.loadComputerId();
            InstitutionCode = library.loadInstitutionCode();
            ClientAppName = library.loadClientAppName();
            ComUrl = library.loadComUrl();
           // CONNECTION_TIMEOUT_MS = Integer.parseInt(library.loadCONNECTION_TIMEOUT_MS());
           CONNECTION_TIMEOUT_MS = Integer.parseInt(library.loadCONNECTION_TIMEOUT_MS().trim());
            branch = library.loadbranch();
            teller = library.loadteller();
            costcenter = library.loadcostcenter();
            trnc = library.loadTrncCode();
           
            /*       
            System.out.println("DEBUG : SignonRole                          ::: " + SignonRole);
            System.out.println("DEBUG : SPName                              ::: " + SPName);
            System.out.println("DEBUG : CustLoginId                         ::: " + CustLoginId);
            System.out.println("DEBUG : comPswd                             ::: " + comPswd);
            System.out.println("DEBUG : ComputerId                          ::: " + ComputerId);
            System.out.println("DEBUG : InstitutionCode                     ::: " + InstitutionCode);
            System.out.println("DEBUG : ClientAppName                       ::: " + ClientAppName);
            System.out.println("DEBUG : ComUrl                              ::: " + ComUrl);
            System.out.println("DEBUG : CONNECTION_TIMEOUT_MS               ::: " + CONNECTION_TIMEOUT_MS);
             */
        } catch (Exception e) {
            System.out.println("Communicator Property retrival Exception : " + e);
            logger.error("Communicator Property retrival Exception Occured");
        }
    }
    
    private String getEffectDate(){
    //String efDate = "";
    GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        txnLibrary = library.loadTxnLibraty();
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        
//        String currentDate = new SimpleDateFormat("yyyyMMdd").format(new java.util.Date());
        try {
            String query = "select PRMVAL as efDate  "
                    + "from CEFTPRM where PRMCODE = 'CUREFDT'";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                efDate = rs.getString("efDate");
            }
        } catch (Exception e) {
            logger.error("Error in load Currency Code : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in colose result set", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in colose statement", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }
        }
    return efDate;
    }

public String[] executeFCITransaction(String fromAcct, String fromAccountType, String toAcct, String toAccountType, String amount,String commission,String descrpt,String txnRef) throws Exception {
 
 double d= 0;
 d = (Double.parseDouble(amount.trim())+Double.parseDouble(commission.trim()));
 String currency = "LKR";
String totAmount =  Double.toString(d);
String trncCode = null;
if(fromAccountType.equalsIgnoreCase("SV")){trncCode = trnc.trim().concat("SG");}
else if (fromAccountType.equalsIgnoreCase("DD")){trncCode = trnc.trim().concat("CG");}
String seqId=txnRef.substring(1);
getEffectDate();
        try {
            uuid = UUID.randomUUID().toString();
            header = "<IFX>\r\n"
                    + "   <SignonRq>\r\n"
                    + "      <SignonPswd>\r\n"
                    + "         <SignonRole>" + SignonRole + "</SignonRole>\r\n"
                    + "         <CustId>\r\n"
                    + "            <SPName>" + SPName + "</SPName>\r\n"
                    + "            <CustLoginId>" + CustLoginId + "</CustLoginId>\r\n"
                    + "         </CustId>\r\n"
                    + "         <CustPswd>\r\n"
                    + "            <CryptType>NONE</CryptType>\r\n"
                    + "            <Pswd>" + comPswd + "</Pswd>\r\n"
                    + "         </CustPswd>\r\n"
                    + "         <GenSessKey>0</GenSessKey>\r\n"
                    + "      </SignonPswd>\r\n"
                    + "      <ClientDt>\r\n"
                    + "         <Year>2011</Year>\r\n"
                    + "         <Month>1</Month>\r\n"
                    + "         <Day>27</Day>\r\n"
                    + "      </ClientDt>\r\n"
                    + "      <ClientApp>\r\n"
                    + "         <Org>Fiserv</Org>\r\n"
                    + "         <Name>" + ClientAppName + "</Name>\r\n"
                    + "         <Version>0.1</Version>\r\n"
                    + "         <ClientAppKey>BOCSRVRHECGNSYSQCUWRJDHKRFDBNTGN</ClientAppKey>\r\n"
                    + "      </ClientApp>\r\n"
                    + "      <ComputerId>" + ComputerId + "</ComputerId>\r\n"
                    + "      <InstitutionCode>" + InstitutionCode + "</InstitutionCode>\r\n"
                    + "   </SignonRq>\r\n"
                    + "   <EnvironmentInfo>\r\n"
                    + "      <EnvironmentName>default</EnvironmentName>\r\n"
                    + "   </EnvironmentInfo>\r\n"
                    + "  <EnvironmentInfo>\r\n"
                    + "   <EnvironmentName>default</EnvironmentName>\r\n"
                    + "   </EnvironmentInfo>\r\n";
                    
            
            middle1 = " <MonSvcRq>\r\n"
                    + "      <RqUID>";
            middle2 = uuid + "</RqUID>\r\n"
                    + "      <SPName>" + SPName + "</SPName>\r\n"
                    + "      <PSAppXferAddRq>\r\n"
                    + "         <RqUID>";
            middle3 = uuid + "</RqUID>\r\n"
                    + "		<TrnCommon>  \r\n"
                    + "     <TrnCode>"+trncCode+"</TrnCode> \r\n"
                    + "         <OverrideCode>T</OverrideCode>\r\n"
                    + "<EffectiveDate>\r\n"
                    + "         <Year>" + efDate.substring(0, 4) + "</Year>\r\n"
                    + "         <Month>" + efDate.substring(4, 6) + "</Month>\r\n"
                    + "         <Day>" + efDate.substring(6, 8) + "</Day>\r\n"
//                      + "         <Year>2022</Year>\r\n"
//                    + "         <Month>09</Month>\r\n"
//                    + "         <Day>02</Day>\r\n"
                    
                    + "      </EffectiveDate>\r\n"
                    + "<BranchId>"+branch+"</BranchId>\r\n"
                    +"<TellerId>"+teller+"</TellerId>\r\n"
                    //+"<SeqId>6490</SeqId>\r\n"
                   +"<SeqId>"+seqId+"</SeqId>\r\n"
                    + "<PCDate>\r\n"
 			+"		<Year>" + timeStamp.substring(0, 4) + "</Year>\r\n"
 			+"		<Month>" + timeStamp.substring(5, 7) + "</Month>\r\n"
 			+"		<Day>" + timeStamp.substring(8,10) + "</Day>\r\n"
 			+"		<Hour>" + timeStamp.substring(11, 13) + "</Hour>\r\n"
 			+"		<Minute>" + timeStamp.substring(14, 16) + "</Minute>\r\n"
 			+"		<Second>" + timeStamp.substring(17, 19) + "</Second>\r\n"
                    +"</PCDate>\r\n"
                    +"</TrnCommon>\r\n"
                    +"<XferInfo>\r\n"                  
                    + "            <DepAcctIdFrom>\r\n"
                    + "               <AcctId>";

            middle4 = fromAcct + "</AcctId>\r\n"
                    + "               <AcctType>";

            middle5 = fromAccountType + "</AcctType>\r\n"
                    + "            </DepAcctIdFrom>\r\n"
                    + "            <GLAcctIdTo>\r\n"
                    + "              <AcctId>";
            middle6 = toAcct + "</AcctId>";

            middle7 = "<AcctType>" + toAccountType + "</AcctType>\r\n"
                    +" <CostCenter>"+costcenter+"</CostCenter>\r\n"
                   // +" <CurCode>"+currency+"</CurCode>\r\n"
                    + "            </GLAcctIdTo>\r\n"
                    + "            <CurAmt>\r\n"
                    + "               <Amt>";
            middle8 = totAmount+ "</Amt>\r\n"
                    + "               <CurCode>";
            middle9 = currency + "</CurCode>	 \r\n"
                    + "            </CurAmt>"
                    +" <TranDesc1>"+descrpt+"</TranDesc1>\r\n"
                     +" <TranDesc4>"+txnRef+"</TranDesc4>\r\n"
                    + "<Fee1Amt>\r\n"
                    +"<Amt>"+commission+"</Amt>"
                    + "</Fee1Amt>\r\n"
                    +" <ToAmt>\r\n"
                    +"<Amt>"+amount + "</Amt>\r\n"
                    +"  <CurCode>"+currency+"</CurCode>\r\n"
                    +"</ToAmt>\r\n"
                    +" <ToTxnAmtLCE>\r\n"
                    +"<Amt>"+amount+"</Amt>\r\n"
                    +"</ToTxnAmtLCE>\r\n";
            footer =  "</XferInfo>\r\n"
                    + "      </PSAppXferAddRq>\r\n"
                    + "    </MonSvcRq>\r\n"
                    + "</IFX>";
////////////////////////////////////Second Message

////////////////////////////////////End Of Second Message
            txnRqXml = header + middle1 + middle2 + middle3 + middle4 + middle5 + middle6 + middle7 + middle8 + middle9 + footer;

            logger.trace("Communicator Request XML :::\r\n" + txnRqXml);
            //log.info(txnRqXml);

        } catch (Exception e) {
            logger.error("Error occured while preparing Request XML::: ", e);
            System.out.println("Exception inside executeEpayTransaction()" + e);
        }
        String[] arr = executeTransaction(txnRqXml,txnRef); 
        jSONObject.put("resultArray", arr);
        //return jSONObject.toString();
        return arr;
        
    }
///////////////////////////////////////
//2 nd xml
//public String executeEpayTransaction1(String fromAcctGL, String fromAccountTypeGL, String toAcctGL, String toAccountTypeGL, String curCode, String amount,String commission) throws Exception {
public String[] executePFCTransaction(String fromAcct,String fromAccountType,String toAcct,String toAccountType,String amount,String currency,String descrpt,String txnRef) throws Exception {
  String trncCode = null;
if(fromAccountType.equalsIgnoreCase("SV")){trncCode = trnc.trim().concat("SG");}
else if (fromAccountType.equalsIgnoreCase("DD")){trncCode = trnc.trim().concat("CG");} 
String seqId=txnRef.substring(1);
 getEffectDate();
 try {
            uuid = UUID.randomUUID().toString();
            header = "<IFX>\r\n"
                    + "   <SignonRq>\r\n"
                    + "      <SignonPswd>\r\n"
                    + "         <SignonRole>" + SignonRole + "</SignonRole>\r\n"
                    + "         <CustId>\r\n"
                    + "            <SPName>" + SPName + "</SPName>\r\n"
                    + "            <CustLoginId>" + CustLoginId + "</CustLoginId>\r\n"
                    + "         </CustId>\r\n"
                    + "         <CustPswd>\r\n"
                    + "            <CryptType>NONE</CryptType>\r\n"
                    + "            <Pswd>" + comPswd + "</Pswd>\r\n"
                    + "         </CustPswd>\r\n"
                    + "         <GenSessKey>0</GenSessKey>\r\n"
                    + "      </SignonPswd>\r\n"
                    + "      <ClientDt>\r\n"
                    + "         <Year>2011</Year>\r\n"
                    + "         <Month>1</Month>\r\n"
                    + "         <Day>27</Day>\r\n"
                    + "      </ClientDt>\r\n"
                    + "      <ClientApp>\r\n"
                    + "         <Org>Fiserv</Org>\r\n"
                    + "         <Name>" + ClientAppName + "</Name>\r\n"
                    + "         <Version>0.1</Version>\r\n"
                    + "         <ClientAppKey>BOCSRVRHECGNSYSQCUWRJDHKRFDBNTGN</ClientAppKey>\r\n"
                    + "      </ClientApp>\r\n"
                    + "      <ComputerId>" + ComputerId + "</ComputerId>\r\n"
                    + "      <InstitutionCode>" + InstitutionCode + "</InstitutionCode>\r\n"
                    + "   </SignonRq>\r\n"
                    + "   <EnvironmentInfo>\r\n"
                    + "      <EnvironmentName>default</EnvironmentName>\r\n"
                    + "   </EnvironmentInfo>\r\n"
                    + "  <EnvironmentInfo>\r\n"
                    + "   <EnvironmentName>default</EnvironmentName>\r\n"
                    + "   </EnvironmentInfo>\r\n";
                    
            
            middle1 = " <MonSvcRq>\r\n"
                    + "      <RqUID>";
            middle2 = uuid + "</RqUID>\r\n"
                    + "      <SPName>" + SPName + "</SPName>\r\n"
                    + "      <PSAppXferAddRq>\r\n"
                    + "         <RqUID>";
            middle3 = uuid + "</RqUID>\r\n"
                    + "		<TrnCommon>  \r\n"
                    + "     <TrnCode>"+trncCode+"</TrnCode> \r\n"
                    + "         <OverrideCode>T</OverrideCode>\r\n"
                    + "<EffectiveDate>\r\n"
                    + "         <Year>" + efDate.substring(0, 4) + "</Year>\r\n"
                    + "         <Month>" + efDate.substring(4, 6) + "</Month>\r\n"
                    + "         <Day>" + efDate.substring(6, 8) + "</Day>\r\n"
                     // + "         <Year>2022</Year>\r\n"
                  //  + "         <Day>02</Day>\r\n"
                    
                    + "      </EffectiveDate>\r\n"
                    + "<BranchId>"+branch+"</BranchId>\r\n"
                    +"<TellerId>"+teller+"</TellerId>\r\n"
                  //  +"<SeqId>7777</SeqId>\r\n"
                    +"<SeqId>"+seqId+"</SeqId>\r\n"
                    + "<PCDate>\r\n"
 			+"		<Year>" + timeStamp.substring(0, 4) + "</Year>\r\n"
 			+"		<Month>" + timeStamp.substring(5, 7) + "</Month>\r\n"
 			+"		<Day>" + timeStamp.substring(8,10) + "</Day>\r\n"
 			+"		<Hour>" + timeStamp.substring(11, 13) + "</Hour>\r\n"
 			+"		<Minute>" + timeStamp.substring(14, 16) + "</Minute>\r\n"
 			+"		<Second>" + timeStamp.substring(17, 19) + "</Second>\r\n"
                    +"</PCDate>\r\n"
                    +"</TrnCommon>\r\n"
                    +"<XferInfo>\r\n"                  
                    + "            <DepAcctIdFrom>\r\n"
                    + "               <AcctId>";

            middle4 = fromAcct+ "</AcctId>\r\n"
                    + "               <AcctType>";

            middle5 = fromAccountType + "</AcctType>\r\n"
                    + "            </DepAcctIdFrom>\r\n"
                    + "            <GLAcctIdTo>\r\n"
                    + "              <AcctId>";
            middle6 = toAcct + "</AcctId>";

            middle7 = "<AcctType>" + toAccountType + "</AcctType>\r\n"
                    +" <CostCenter>"+costcenter+"</CostCenter>\r\n"
                    +" <CurCode>"+currency+"</CurCode>\r\n"
                    + "            </GLAcctIdTo>\r\n"
                    + "            <CurAmt>\r\n"
                    + "               <Amt>";
            middle8 = amount+ "</Amt>\r\n"
                    + "               <CurCode>";
            middle9 = currency + "</CurCode>	 \r\n"
                    + "            </CurAmt>"
                    +" <TranDesc1>"+descrpt+"</TranDesc1>\r\n"
                     +" <TranDesc4>"+txnRef+"</TranDesc4>\r\n"
                    +" <ToAmt>\r\n"
                    +"<Amt>"+amount + "</Amt>\r\n"
                    +"  <CurCode>"+currency+"</CurCode>\r\n"
                    +"</ToAmt>\r\n";
            footer =  "</XferInfo>\r\n"
                    + "      </PSAppXferAddRq>\r\n"
                    + "    </MonSvcRq>\r\n"
                    + "</IFX>";
////////////////////////////////////Second Message

////////////////////////////////////End Of Second Message
            txnRqXml = header + middle1 + middle2 + middle3 + middle4 + middle5 + middle6 + middle7 + middle8 + middle9 + footer;

            logger.trace("Communicator Request XML :::\r\n" + txnRqXml);
            //log.info(txnRqXml);

        } catch (Exception e) {
            logger.error("Error occured while preparing Request XML::: ", e);
            System.out.println("Exception inside executeEpayTransaction()" + e);
        }
         String[] arr = executeTransaction(txnRqXml,txnRef); 
         
        jSONObject.put("resultArray", arr);
        //saveCommunicator(txnRef,"7777",txnRqXml,txnRqXml,amount,"PFC");
       // return jSONObject.toString();
       return arr;
      
       
    }

    private String[] executeTransaction(String txnRqXml,String txnRef) throws Exception {

        try {
            String LvMessage = "MSG|" + WriteFile.getCurrentDateandTime();
             WriteFile.WriteInfor(LvMessage);       
            WriteFile.WriteInfor(txnRqXml);
            client = new DefaultHttpClient();
            post = new HttpPost(ComUrl);
            
            //connection will be timeout in 10 secs
            RequestConfig reqConfig = RequestConfig.custom().setSocketTimeout(CONNECTION_TIMEOUT_MS).build();
            post.setConfig(reqConfig);
            //client
            entity = new ByteArrayEntity(txnRqXml.getBytes("UTF-8"));
            post.setEntity(entity);
            //System.out.println("STARTED COmm in nano secs: "+System.nanoTime());
            String certificatesTrustStorePath = "C:\\Program Files\\Java\\jre1.8.0_181\\lib\\security\\cacerts";

            System.setProperty("javax.net.ssl.trustStore", certificatesTrustStorePath);
            System.setProperty("javax.net.ssl.trustStorePassword", "changeit");

            long startTime = System.nanoTime();
            //TimeUnit.SECONDS.sleep(60); // to delete
            
            response = client.execute(post);
            //System.out.println("ENDED COmm in nano secs: "+System.nanoTime());
           
        //////////////////////////////////////
            long endTime = System.nanoTime();
            long elapsedTimeinSecs = TimeUnit.SECONDS.convert((endTime-startTime), TimeUnit.NANOSECONDS);
            System.out.println("Time taken to process comm request in secs::: "+ elapsedTimeinSecs);
            logger.info("Time taken to process comm request in secs: "+ elapsedTimeinSecs);
           
        
            result =  EntityUtils.toString(response.getEntity());
         
            WriteFile.WriteInfor(result);
            logger.trace("Communicator response XML :::\r\n" + result);
            
            dbFactory = DocumentBuilderFactory.newInstance();
            dBuilder = dbFactory.newDocumentBuilder();
           doc = dBuilder.parse(new InputSource(new ByteArrayInputStream(result.getBytes("utf-8"))));
           
           doc.getDocumentElement().normalize();




            //System.out.println("Root element :" + doc.getDocumentElement().getNodeName());
            
            nList1 = doc.getElementsByTagName("GeneralStatus");
            
            for(int i = 0;i < nList1.getLength(); i++){
                nNode1 = nList1.item(i);
                
                //System.out.println("\nCurrent Element :" + nNode1.getNodeName());//to be commented
                
                if(nNode1.getNodeType() == Node.ELEMENT_NODE){
                    eElement1 = (Element) nNode1;
                    StatusCode = eElement1.getElementsByTagName("StatusCode").item(0).getTextContent();
                    System.out.println("Response StatusCode--"+StatusCode);
                    
                    if("0".equals(StatusCode)){
                        Desc = eElement1.getElementsByTagName("StatusDesc").item(0).getTextContent();
                        
                        nList2 = doc.getElementsByTagName("XferRec");
            
                         for(int x = 0; x< nList2.getLength();x++){
                             nNode2 = nList2.item(i);
                             
                
                             if(nNode2.getNodeType()==Node.ELEMENT_NODE){
                             eElement2 = (Element)nNode2;
                             hostRefNo = eElement2.getElementsByTagName("XferId").item(0).getTextContent();
                             System.out.println("\nHost Reference No :" + hostRefNo);
                     
                    
                                }
                            }
                         addToTable(txnRef, "Y");
                        
                    }else{
                        Desc = eElement1.getElementsByTagName("ErrDesc").item(0).getTextContent();
                        ErrNum = eElement1.getElementsByTagName("ErrNum").item(0).getTextContent();
                        addToTable(txnRef, "N");
                        
                    }
                    results = new String[]{StatusCode,Desc,ErrNum,hostRefNo};
                  
                }
            }
            
          
        
            
            System.out.println("-------------Communicator Response Returned---------------");
            //log.Trace("Communicator Response Statuscode: " + results[0]+"--Desc: "+results[1]+"--ErrNum: "+results[2]);

} catch (IOException | ParseException | ParserConfigurationException | SAXException | DOMException e) {

    results = new String[]{"xxx","Exception in communicator class","xxx","xxx"}; 
            addToTable(txnRef, "N");
System.out.println("Exception inside executeTransaction()" + e);
            logger.error("Communicator Error while processing the request :" + e.getMessage());     
           
        }
     saveCommunicator(txnRqXml,result);
         return results;
    
    }
    
    
    
    private void saveCommunicator(String txnRqXml,String result)
    {
    SimpleDateFormat date_Format = new SimpleDateFormat("yyyy_MM_dd");
  	Calendar cal = Calendar.getInstance();
        String c_date = date_Format.format(cal.getTime());
        String log_f_name="Log/CommMsg_" + c_date.substring(0,4) + "-" + c_date.substring(5,7) + "-" + c_date.substring(8,10) + ".log";
        
        
        File logfile = new File(log_f_name);
        try
        {			
            FileWriter file = new FileWriter(logfile,true); // Create Log file if not exist 
            BufferedWriter log = new BufferedWriter(file);
            log.write(timeStamp);
            log.write("\r\n");
            log.write(txnRqXml);            
            log.write("\r\n");	
            log.write(result);
            log.write("**************************************");
            log.write("\r\n");
            log.close(); //Close the output stream
        }
        catch (Exception e)
        {       
                //LogWrite("Error in Log File: " + e.getMessage());
		System.err.println("Error in Log File: " + e.getMessage());
	}
    }
   
private void addToTable(String txnRef,String key) throws ClassNotFoundException{
 GetDataLibrary library = new GetDataLibrary();
 InsertTableData insertTableData = new InsertTableData();
        txnLibrary = library.loadTxnLibraty();
        String key2 = "";
boolean resp = false;
      if(key.equals("N")) {key2 = "F";} 
        
       String  query = "Update "+txnLibrary+".PYP00301 set TRCMNSTA = '"+key+"',TRSTATUS='"+key2+"' where TRREFNUM = '"+txnRef+"'";
      try {
            
            resp = insertTableData.insertTableData(query);

        } catch (Exception e) {
            logger.error("Error in deal state change : ", e);
        }
}

}



