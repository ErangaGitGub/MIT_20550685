/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.model;

/**
 *
 * @author it207416
 */
public class AcceptCash {
    private String fromTill;
    private String curr;
    private Double amount;
    private String trnUsr;
    private String trnTime;
    private String dstTill;

    public String getFromTill() {
        return fromTill;
    }

    public String getDstTill() {
        return dstTill;
    }

    public String getCurr() {
        return curr;
    }

    public double getAmount() {
        return amount;
    }

    public String getTrnUsr() {
        return trnUsr;
    }

    public String getTrnTime() {
        return trnTime;
    }

    public void setFromTill(String fromTill) {
        this.fromTill = fromTill;
    }

    public void setCurr(String curr) {
        this.curr = curr;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public void setTrnUsr(String trnUsr) {
        this.trnUsr = trnUsr;
    }

    public void setTrnTime(String trnTime) {
        this.trnTime = trnTime;
    }

    public void setDstTill(String dstTill) {
        this.dstTill = dstTill;
    }
    
}
