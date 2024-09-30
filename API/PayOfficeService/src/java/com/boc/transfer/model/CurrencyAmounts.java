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
public class CurrencyAmounts {

    private String curr;
    private Double currAmount;

    public void setCurr(String curr) {
        this.curr = curr;
    }

    public void setCurrAmount(Double currAmount) {
        this.currAmount = currAmount;
    }

    public String getCurr() {
        return curr;
    }

    public Double getCurrAmount() {
        return currAmount;
    }

}
