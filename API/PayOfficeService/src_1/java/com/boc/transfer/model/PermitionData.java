/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.model;

/**
 *
 * @author it207458
 */
public class PermitionData {
    private int id;
    private int clusterId;
    private String clusterCode; 
    private int isAllow;
    private String userLevel;
    
    private int initialView;
    private int initialAdd;
    private int initialModify;
    private int initialVerification;
    private int initialAuthorization;
    
    private int aditionallView;
    private int aditionalAdd;
    private int aditionalModify;
    private int aditionalVerification;
    private int aditionalAuthorization;
    
    private int inqueryAll;
    private int reportsAll;
    private int messageSelection;
    private int nostroSelection;
    
    private int systemManager;
    private int configManager;
    
    private int allocateFund;
    private int allocateRate;
    private int viewFund;
    private int viewRate;
    private int paymentView;
    private int viewAllFund;
    private int viewAllRate;
    
    private int sendSMS;
    private int sendEMail;
    private int printReceipt;
    private int logView;
    
    private int optionsView;
    private int cancelRequest;
       
    private int saveOnly;
    private int userSelect;

    /**
     * @return the id
     */
    public int getId() {
        return id;
    }

    /**
     * @param id the id to set
     */
    public void setId(int id) {
        this.id = id;
    }

    /**
     * @return the clusterId
     */
    public int getClusterId() {
        return clusterId;
    }

    /**
     * @param clusterId the clusterId to set
     */
    public void setClusterId(int clusterId) {
        this.clusterId = clusterId;
    }

    /**
     * @return the clusterCode
     */
    public String getClusterCode() {
        return clusterCode;
    }

    /**
     * @param clusterCode the clusterCode to set
     */
    public void setClusterCode(String clusterCode) {
        this.clusterCode = clusterCode;
    }

    /**
     * @return the isAllow
     */
    public int getIsAllow() {
        return isAllow;
    }

    /**
     * @param isAllow the isAllow to set
     */
    public void setIsAllow(int isAllow) {
        this.isAllow = isAllow;
    }

    /**
     * @return the userLevel
     */
    public String getUserLevel() {
        return userLevel;
    }

    /**
     * @param userLevel the userLevel to set
     */
    public void setUserLevel(String userLevel) {
        this.userLevel = userLevel;
    }

    /**
     * @return the nostroSelection
    */
    public int getNostroSelection() {
        return nostroSelection;
    }

    /**
     * @param nostroSelection the nostroSelection to set
     */
    public void setNostroSelection(int nostroSelection) {
        this.nostroSelection = nostroSelection;
    }

    /**
     * @return the initialView
     */
    public int getInitialView() {
        return initialView;
    }

    /**
     * @param initialView the initialView to set
     */
    public void setInitialView(int initialView) {
        this.initialView = initialView;
    }

    /**
     * @return the initialAdd
     */
    public int getInitialAdd() {
        return initialAdd;
    }

    /**
     * @param initialAdd the initialAdd to set
     */
    public void setInitialAdd(int initialAdd) {
        this.initialAdd = initialAdd;
    }

    /**
     * @return the initialModify
     */
    public int getInitialModify() {
        return initialModify;
    }

    /**
     * @param initialModify the initialModify to set
     */
    public void setInitialModify(int initialModify) {
        this.initialModify = initialModify;
    }

    /**
     * @return the initialVerification
     */
    public int getInitialVerification() {
        return initialVerification;
    }

    /**
     * @param initialVerification the initialVerification to set
     */
    public void setInitialVerification(int initialVerification) {
        this.initialVerification = initialVerification;
    }

    /**
     * @return the initialAuthorization
     */
    public int getInitialAuthorization() {
        return initialAuthorization;
    }

    /**
     * @param initialAuthorization the initialAuthorization to set
     */
    public void setInitialAuthorization(int initialAuthorization) {
        this.initialAuthorization = initialAuthorization;
    }

    /**
     * @return the aditionallView
     */
    public int getAditionallView() {
        return aditionallView;
    }

    /**
     * @param aditionallView the aditionallView to set
     */
    public void setAditionallView(int aditionallView) {
        this.aditionallView = aditionallView;
    }

    /**
     * @return the aditionalAdd
     */
    public int getAditionalAdd() {
        return aditionalAdd;
    }

    /**
     * @param aditionalAdd the aditionalAdd to set
     */
    public void setAditionalAdd(int aditionalAdd) {
        this.aditionalAdd = aditionalAdd;
    }

    /**
     * @return the aditionalModify
     */
    public int getAditionalModify() {
        return aditionalModify;
    }

    /**
     * @param aditionalModify the aditionalModify to set
     */
    public void setAditionalModify(int aditionalModify) {
        this.aditionalModify = aditionalModify;
    }

    /**
     * @return the aditionalVerification
     */
    public int getAditionalVerification() {
        return aditionalVerification;
    }

    /**
     * @param aditionalVerification the aditionalVerification to set
     */
    public void setAditionalVerification(int aditionalVerification) {
        this.aditionalVerification = aditionalVerification;
    }

    /**
     * @return the aditionalAuthorization
     */
    public int getAditionalAuthorization() {
        return aditionalAuthorization;
    }

    /**
     * @param aditionalAuthorization the aditionalAuthorization to set
     */
    public void setAditionalAuthorization(int aditionalAuthorization) {
        this.aditionalAuthorization = aditionalAuthorization;
    }

    /**
     * @return the messageSelection
     */
    public int getMessageSelection() {
        return messageSelection;
    }

    /**
     * @param messageSelection the messageSelection to set
     */
    public void setMessageSelection(int messageSelection) {
        this.messageSelection = messageSelection;
    }

    /**
     * @return the inqueryAll
     */
    public int getInqueryAll() {
        return inqueryAll;
    }

    /**
     * @param inqueryAll the inqueryAll to set
     */
    public void setInqueryAll(int inqueryAll) {
        this.inqueryAll = inqueryAll;
    }

    /**
     * @return the reportsAll
     */
    public int getReportsAll() {
        return reportsAll;
    }

    /**
     * @param reportsAll the reportsAll to set
     */
    public void setReportsAll(int reportsAll) {
        this.reportsAll = reportsAll;
    }

    /**
     * @return the systemManager
     */
    public int getSystemManager() {
        return systemManager;
    }

    /**
     * @param systemManager the systemManager to set
     */
    public void setSystemManager(int systemManager) {
        this.systemManager = systemManager;
    }

    /**
     * @return the configManager
     */
    public int getConfigManager() {
        return configManager;
    }

    /**
     * @param configManager the configManager to set
     */
    public void setConfigManager(int configManager) {
        this.configManager = configManager;
    }

    /**
     * @return the allocateFund
     */
    public int getAllocateFund() {
        return allocateFund;
    }

    /**
     * @param allocateFund the allocateFund to set
     */
    public void setAllocateFund(int allocateFund) {
        this.allocateFund = allocateFund;
    }

    /**
     * @return the allocateRate
     */
    public int getAllocateRate() {
        return allocateRate;
    }

    /**
     * @param allocateRate the allocateRate to set
     */
    public void setAllocateRate(int allocateRate) {
        this.allocateRate = allocateRate;
    }

    /**
     * @return the viewFund
     */
    public int getViewFund() {
        return viewFund;
    }

    /**
     * @param viewFund the viewFund to set
     */
    public void setViewFund(int viewFund) {
        this.viewFund = viewFund;
    }

    /**
     * @return the viewRate
     */
    public int getViewRate() {
        return viewRate;
    }

    /**
     * @param viewRate the viewRate to set
     */
    public void setViewRate(int viewRate) {
        this.viewRate = viewRate;
    }

    /**
     * @return the paymentView
     */
    public int getPaymentView() {
        return paymentView;
    }

    /**
     * @param paymentView the paymentView to set
     */
    public void setPaymentView(int paymentView) {
        this.paymentView = paymentView;
    }

    /**
     * @return the sendSMS
     */
    public int getSendSMS() {
        return sendSMS;
    }

    /**
     * @param sendSMS the sendSMS to set
     */
    public void setSendSMS(int sendSMS) {
        this.sendSMS = sendSMS;
    }

    /**
     * @return the sendEMail
     */
    public int getSendEMail() {
        return sendEMail;
    }

    /**
     * @param sendEMail the sendEMail to set
     */
    public void setSendEMail(int sendEMail) {
        this.sendEMail = sendEMail;
    }

    /**
     * @return the printReceipt
     */
    public int getPrintReceipt() {
        return printReceipt;
    }

    /**
     * @param printReceipt the printReceipt to set
     */
    public void setPrintReceipt(int printReceipt) {
        this.printReceipt = printReceipt;
    }

    /**
     * @return the logView
     */
    public int getLogView() {
        return logView;
    }

    /**
     * @param logView the logView to set
     */
    public void setLogView(int logView) {
        this.logView = logView;
    }

    /**
     * @return the viewAllFund
     */
    public int getViewAllFund() {
        return viewAllFund;
    }

    /**
     * @param viewAllFund the viewAllFund to set
     */
    public void setViewAllFund(int viewAllFund) {
        this.viewAllFund = viewAllFund;
    }

    /**
     * @return the viewAllRate
     */
    public int getViewAllRate() {
        return viewAllRate;
    }

    /**
     * @param viewAllRate the viewAllRate to set
     */
    public void setViewAllRate(int viewAllRate) {
        this.viewAllRate = viewAllRate;
    }

    /**
     * @return the optionsView
     */
    public int getOptionsView() {
        return optionsView;
    }

    /**
     * @param optionsView the optionsView to set
     */
    public void setOptionsView(int optionsView) {
        this.optionsView = optionsView;
    }

    /**
     * @return the cancelRequest
     */
    public int getCancelRequest() {
        return cancelRequest;
    }

    /**
     * @param cancelRequest the cancelRequest to set
     */
    public void setCancelRequest(int cancelRequest) {
        this.cancelRequest = cancelRequest;
    }

    /**
     * @return the saveOnly
     */
    public int getSaveOnly() {
        return saveOnly;
    }

    /**
     * @param saveOnly the saveOnly to set
     */
    public void setSaveOnly(int saveOnly) {
        this.saveOnly = saveOnly;
    }

    /**
     * @return the userSelect
     */
    public int getUserSelect() {
        return userSelect;
    }

    /**
     * @param userSelect the userSelect to set
     */
    public void setUserSelect(int userSelect) {
        this.userSelect = userSelect;
    }

}