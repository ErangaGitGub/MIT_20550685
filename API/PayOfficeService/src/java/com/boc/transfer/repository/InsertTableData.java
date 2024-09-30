/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;
import org.apache.log4j.Logger;

/**
 *
 * @author it207458
 */
public class InsertTableData {

    Logger logger = Logger.getLogger(InsertTableData.class.getName());

    public boolean insertTableData(String query) {
        int status = 0;
        Statement stmnt = null;
           Connection con = null;
        try {
            con = DbConnection.getConnection();
            stmnt = con.createStatement();
             status = stmnt.executeUpdate(query);
        } catch (Exception e) {
            logger.error("Error in insertTableData : ", e);
        } finally {
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
        if (status == 0) {
            return false;
        } else {
            return true;
        }

    }
}
