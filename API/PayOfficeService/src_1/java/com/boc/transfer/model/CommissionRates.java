/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.model;

/**
 *
 * @author it203886
 */
public class CommissionRates {
    private Double minVal;
    private Double maxVal;
    private Double comPerctge;
    private Double comValue;
    private Double comming;

    public Double getMinVal() {
        return minVal;
    }

    public Double getMaxVal() {
        return maxVal;
    }

    public Double getComPerctge() {
        return comPerctge;
    }

    public Double getComValue() {
        return comValue;
    }

    public Double getComming() {
        return comming;
    }

    public void setMinVal(Double minVal) {
        this.minVal = minVal;
    }

    public void setMaxVal(Double maxVal) {
        this.maxVal = maxVal;
    }

    public void setComPerctge(Double comPerctge) {
        this.comPerctge = comPerctge;
    }

    public void setComValue(Double comValue) {
        this.comValue = comValue;
    }

    public void setComming(Double comming) {
        this.comming = comming;
    }

    
    
}
