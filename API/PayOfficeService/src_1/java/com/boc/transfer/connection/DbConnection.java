/**
 * @author dinesh
 */
package com.boc.transfer.connection;

import com.boc.transfer.repository.GetDataLibrary;
import com.ibm.as400.access.AS400;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;
import org.apache.log4j.Logger;

/**
 * @author dinesh
 */
public class DbConnection {

    Logger logger = Logger.getLogger(DbConnection.class.getName());

//    public static Connection getConnection() throws SQLException {
//        InitialContext ctx;
//        Connection conn = null;
//        try {
//            ctx = new javax.naming.InitialContext();
//            DataSource ds = (javax.sql.DataSource) ctx.lookup("DB2POOL");
//            conn = ds.getConnection();
//        } catch (NamingException ex) {
//            java.util.logging.Logger.getLogger(DbConnection.class.getName()).log(Level.SEVERE, null, ex);
//        }
//        return conn;
//    }

    
        public static Connection getConnection() throws SQLException, ClassNotFoundException {
        GetDataLibrary library = new GetDataLibrary();
        String treasuryLibrary = library.loadTxnLibraty();
        Class.forName("com.ibm.as400.access.AS400JDBCDriver");
        String dataLibrary = library.loadDataLibraty();
        return DriverManager.getConnection(
                "jdbc:as400:" + "172.23.32.9" 
              + ";database name=" + treasuryLibrary + ""
              + ";prompt=false"
              + ";translate binary=true"
              + ";libraries=" + dataLibrary + ""
              + ";naming=system",
                 "payofusr",
                 "usrpayof");
    } 
        //itrsuser :usritrs
    
    public static AS400 getAS400() {
        String HOST = "172.23.32.9";
        String UID = "payofusr";
        String PWD = "usrpayof";
        return new AS400(HOST, UID, PWD);        
    }
    
    private DbConnection() {

    }
}
