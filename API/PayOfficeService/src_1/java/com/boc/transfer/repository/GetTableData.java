/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import com.boc.transfer.connection.DbConnection;
import com.boc.transfer.converter.JsonConvertor;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import org.apache.log4j.Logger;
import org.json.JSONArray;

/**
 *
 * @author it207458
 */
public class GetTableData {

    Logger logger = Logger.getLogger(GetTableData.class.getName());
    public JSONArray convertToJSON;
    public JSONArray emptyJSON = new JSONArray();

    public String getDBData(String query) {
        Statement stmnt = null;
        ResultSet rs = null;
        Connection connection = null;
        JsonConvertor conObj = new JsonConvertor();
        try {
            connection = DbConnection.getConnection();
        } catch (Exception e) {
            logger.error("Error in create connection : ", e);
        }
        try {
            stmnt = connection.createStatement();
            rs = stmnt.executeQuery(query);
            convertToJSON = conObj.rsToJson(rs, emptyJSON);
        } catch (Exception e) {
            logger.error("Ettror in get table data : ", e);
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
                connection.close();
                
            } catch (SQLException ex) {
                logger.error("Error in colose connesction", ex);
            }

        }
        return convertToJSON.toString();
    }

}
