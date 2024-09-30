/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.controller;

import java.io.InputStream;
import java.util.Properties;
import org.apache.log4j.Logger;
 
/**
 *
 * @author it207458
 */
public class ApiAuthontication {

    private static String apiKey;
    boolean userAuthonticated = false;
    Logger logger = Logger.getLogger(ApiAuthontication.class.getName());

    public boolean isUserAuthenticated(String authString) {
        if ((apiKey == null) || (apiKey.isEmpty())) {
            loadApiKey();
        }
        if (apiKey.equals(authString)) {
            userAuthonticated = true;
        } else {
            userAuthonticated = false;
        }

        return userAuthonticated;
    }

    private void loadApiKey() {
        Properties prop = new Properties();
        InputStream input = null;
        try {
            input = ApiAuthontication.class.getClassLoader().getResourceAsStream("com/boc/transfer/properties/config.properties");
            prop.load(input);
            apiKey = prop.getProperty("rest.api.key");
            apiKey = apiKey.trim();
        } catch (Exception e) {
            logger.error("Error in Load API Key", e);
        }
    }
}
