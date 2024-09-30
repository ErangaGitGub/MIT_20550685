/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import org.apache.log4j.Logger;

/**
 *
 * @author it207458
 */
public class BranchRepository {

    private static String dataLibrary;
    Logger logger = Logger.getLogger(BranchRepository.class.getName());

    public String getBranchName(int bCode) {
        GetDataLibrary library = new GetDataLibrary();
        dataLibrary = library.loadDataLibraty();
        String branchName = "";
        Statement stmnt = null;
        ResultSet rs = null;
        Connection con = null;
        try {
            String query = "select CFBRNM from " + dataLibrary + ".CFP102 where CFBRCH = " + bCode + "";
            try {
                con = DbConnection.getConnection();
            } catch (SQLException e) {
                logger.error("Error in create connection : ", e);
            }
            stmnt = con.createStatement();
            rs = stmnt.executeQuery(query);
            while (rs.next()) {
                branchName = rs.getString("CFBRNM");
            }
        } catch (Exception e) {
            logger.error("Error in load Branch Name : ", e);
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
        return branchName;
    }
}
