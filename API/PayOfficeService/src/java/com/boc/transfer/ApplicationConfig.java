/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * @author dinesh
 */
package com.boc.transfer;

import java.util.Set;
import javax.ws.rs.core.Application;


/**
 *
 * @author it207458
 */
@javax.ws.rs.ApplicationPath("webresources")
 
public class ApplicationConfig extends Application {

    @Override
    public Set<Class<?>> getClasses() {
        Set<Class<?>> resources = new java.util.HashSet<>();
        addRestResourceClasses(resources);
        return resources;
    }

    /**
     * Do not modify addRestResourceClasses() method.
     * It is automatically populated with
     * all resources defined in the project.
     * If required, comment out calling this method in getClasses().
     */
    private void addRestResourceClasses(Set<Class<?>> resources) {
        resources.add(com.boc.transfer.TestResource.class);
        resources.add(com.boc.transfer.controller.AuthController.class);
        resources.add(com.boc.transfer.controller.CommunicatorController.class);
        resources.add(com.boc.transfer.controller.CurrencyController.class);
        resources.add(com.boc.transfer.controller.EODBODController.class);
        resources.add(com.boc.transfer.controller.LoginController.class);
        resources.add(com.boc.transfer.controller.TranasactionController.class);
        resources.add(com.boc.transfer.controller.UserController.class);
        resources.add(com.boc.transfer.controller.VaultController.class);
    }
    
}
