/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import java.io.FileInputStream;
import java.io.InputStream;
import java.util.Properties;
import org.apache.log4j.Logger;

/**
 *
 * @author it207458
 */
public class GetDataLibrary {

    Logger logger = Logger.getLogger(GetDataLibrary.class.getName());
    private static String dataLibrary;

    public String loadDataLibraty() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("icbs.data.library");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadSRVLibraty() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("icbs.srv.library");
        } catch (Exception e) {
            logger.error("Error in loadSRVLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadTxnLibraty() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("icbs.txn.library");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }
    
    public String loadIncentivePercentage() {
        Properties prop = new Properties();
        InputStream input = null;
   
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("icbs.txn.incentive.percentage");
        } catch (Exception e) {
            logger.error("Error in load incentive percentage : ", e);
        }
        return dataLibrary;
    }

//    String loadTxnLibrary() {
//        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
//    }
    //    String loadTxnLibrary() {
//        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
//    }
//////////////////////////////////
    public String loadSignonRole() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("SignonRole");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadSPName() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("SPName");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadCustLoginId() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("CustLoginId");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadcomPswd() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("comPswd");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadComputerId() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("ComputerId");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadInstitutionCode() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("InstitutionCode");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadClientAppName() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("ClientAppName");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadComUrl() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("ComUrl");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadCONNECTION_TIMEOUT_MS() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("CONNECTION_TIMEOUT_MS");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadbranch() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("branch");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadteller() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("teller");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }

    public String loadcostcenter() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("costcenter");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }
    
     public String loadToAccount() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("ToAccount");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }
    
    public String loadToAccType() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("ToAccType");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }
    
     public String loadcurCode() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("curCode");
        } catch (Exception e) {
            logger.error("Error in loadDataLibraty : ", e);
        }
        return dataLibrary;
    }
     
     
      public String loadTrncCode() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = GetDataLibrary.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            dataLibrary = prop.getProperty("trnc");
        } catch (Exception e) {
            logger.error("Error in loadTrncCode : ", e);
        }
        return dataLibrary;
    }
     
//////////////////////////////////

}
