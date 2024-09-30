/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.generator;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.repository.GetDataLibrary;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.Statement;
import org.apache.log4j.Logger;
import java.sql.SQLException;

/**
 *
 * @author IT203886
 */
public class SerialNumber {

    Logger logger = Logger.getLogger(SerialNumber.class.getName());
    private static String txnLibrary;
    public Statement stmnt = null;
    public ResultSet rs = null;
    Connection con = null;
    int serialNumber = 0;
    String dealPrefix;

    public int generatePayOffUserSerial() {
        dealPrefix = "POF";
        GetDataLibrary library = new GetDataLibrary();
        txnLibrary = library.loadTxnLibraty();
        int count = 0;
        try {
            String query = "select count(*) as count from " + txnLibrary + ".PYP00901";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                count = rs.getInt("count");
            }
        } catch (Exception e) {
            logger.error("Error in load  count : ", e);
        } finally {
            try {
                rs.close();
            } catch (SQLException ex) {
                logger.error("Error in close result set", ex);
            }
            try {
                stmnt.close();
            } catch (SQLException ex) {
                logger.error("Error in close statement", ex);
            }
            try {
                con.close();
            } catch (SQLException ex) {
                logger.error("Error in close connesction", ex);
            }
        }
        try {
            count = count + 1;
            //serialNumber = dealPrefix.concat(String.format("%06d", count));
            serialNumber = count;
        } catch (Exception e) {
            logger.error("Error in generating the serial number : ", e);
        }
        return serialNumber;
    }
}
