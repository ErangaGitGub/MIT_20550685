/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.model;

/**
 *
 * @author Dinesh
 */
public class UserData {

    private String userId = "";
    private String userLevel = "";
    private String userTill = "";
    private String userLevelDesc = "";
    private String userTillDesc = "";
    private String rateState = "";
    private String password;
    private String branch;
    private String resetPassword;
    

    public void setRateState(String rateState) {
        this.rateState = rateState;
    }

    public String getRateState() {
        return rateState;
    }

    public String getUserLevelDesc() {
        return userLevelDesc;
    }

    public void setUserLevelDesc(String userLevelDesc) {
        this.userLevelDesc = userLevelDesc;
    }

    public String getUserTillDesc() {
        return userTillDesc;
    }

    public void setUserTillDesc(String userTillDesc) {
        this.userTillDesc = userTillDesc;
    }
    private String branchCode = "";
    private String branchName = "";
    private String name = "";
    private String userStatus = "";
    private String rateStatus = "";
    private String errorCode = "";
    private String profile = "";
    private String pfNumber = "";
    private String enteredDate = "";

    public String getRateStatus() {
        return rateStatus;
    }

    public void setRateStatus(String rateStatus) {
        this.rateStatus = rateStatus;
    }
    private String enteredUser = "";
    private String enteredIP = "";
    private String enteredHost = "";
    private String lastlogDate = "";
    private String lastLogTime = "";
    private String effectiveDate = "";

    public String getUserTill() {
        return userTill;
    }

    public void setUserTill(String userTill) {
        this.userTill = userTill;
    }

    public String getEffectiveDate() {
        return effectiveDate;
    }

    public void setEffectiveDate(String effectiveDate) {
        this.effectiveDate = effectiveDate;
    }
    /**
     * Error Codes 100 = User ID not found
     *
     */

    /**
     * @return the userId
     */
    public String getUserId() {
        return userId;
    }

    /**
     * @param userId the userId to set
     */
    public void setUserId(String userId) {
        this.userId = userId;
    }

    /**
     * @return the branchCode
     */
    public String getBranchCode() {
        return branchCode;
    }

    /**
     * @param branchCode the branchCode to set
     */
    public void setBranchCode(String branchCode) {
        this.branchCode = branchCode;
    }

    /**
     * @return the name
     */
    public String getName() {
        return name;
    }

    /**
     * @param name the name to set
     */
    public void setName(String name) {
        this.name = name;
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
     * @return the userTill
     */
    public String getuserTill() {
        return userTill;
    }

    /**
     * @param userTill the userTill to set
     */
    public void setuserTill(String userTill) {
        this.userTill = userTill;
    }

    /**
     * @return the userStatus
     */
    public String getUserStatus() {
        return userStatus;
    }

    /**
     * @param userStatus the userStatus to set
     */
    public void setUserStatus(String userStatus) {
        this.userStatus = userStatus;
    }

    /**
     * @return the errorCode
     */
    public String getErrorCode() {
        return errorCode;
    }

    /**
     * @param errorCode the errorCode to set
     */
    public void setErrorCode(String errorCode) {
        this.errorCode = errorCode;
    }

    /**
     * @return the profile
     */
    public String getProfile() {
        return profile;
    }

    public String getLastlogDate() {
        return lastlogDate;
    }

    public String getLastLogTime() {
        return lastLogTime;
    }

    /**
     * @param profile the profile to set
     */
    public void setProfile(String profile) {
        this.profile = profile;
    }

    public String getPfNumber() {
        return pfNumber;
    }

    public void setPfNumber(String pfNumber) {
        this.pfNumber = pfNumber;
    }

    public String getEnteredUser() {
        return enteredUser;
    }

    public void setEnteredUser(String enteredUser) {
        this.enteredUser = enteredUser;
    }

    public String getEnteredIP() {
        return enteredIP;
    }

    public void setEnteredIP(String enteredIP) {
        this.enteredIP = enteredIP;
    }

    public String getEnteredHost() {
        return enteredHost;
    }

    public void setEnteredHost(String enteredHost) {
        this.enteredHost = enteredHost;
    }

    public String getEnteredDate() {
        return enteredDate;
    }

    public void setEnteredDate(String enteredDate) {
        this.enteredDate = enteredDate;
    }

    public void setLastlogDate(String lastlogDate) {
        this.lastlogDate = lastlogDate;
    }

    public void setLastLogTime(String lastLogTime) {
        this.lastLogTime = lastLogTime;
    }

    public String getBranchName() {
        return branchName;
    }

    public void setBranchName(String branchName) {
        this.branchName = branchName;
    }
    
    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
    
    public String getBranch() {
        return branch;
    }

    public void setBranch(String branch) {
        this.branch = branch;
    }
    
    public String getResetPassword() {
        return resetPassword;
    }

    public void setResetPassword(String resetPassword) {
        this.resetPassword = resetPassword;
    }
    

}
