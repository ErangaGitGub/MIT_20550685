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
public class ITRSInternationalTxn {
    private String uinnumber;
    private String uincode;
    private String transactionType;
    private String accountNo;
    private String passportNo;
    private String natureOfTxnCode;
    private String title;
    private String fname;
    private String airticketno;
    private String custaddr1;
    private String custaddr2;
    private String custaddr3;
    private String cusname;
    private String itrscode;
    private String accounttypecode;
    private String sectorcode;
    private String majorcountry;
    private String icurrencyselector1;
    private String icurrencyselector2;
    private String icurrencyselector3;
    private String icurrencyselector4;
    private String rate1;
    private String rate2;
    private String rate3;
    private String rate4;
    private String defaultRate1;
    private String defaultRate2;
    private String defaultRate3;
    private String defaultRate4;
    private String tamount1;
    private String tamount2;
    private String tamount3;
    private String tamount4;
    private String camount1;
    private String camount2;
    private String camount3;
    private String camount4;
    private String usdCrossRate1;
    private String usdCrossRate2;
    private String usdCrossRate3;
    private String usdCrossRate4;
    private String usdEqvAmount1;
    private String usdEqvAmount2;
    private String usdEqvAmount3;
    private String usdEqvAmount4;
    private String IncentiveAmount1;
    private String IncentiveAmount2;
    private String IncentiveAmount3;
    private String IncentiveAmount4;    
    private String commissionPercentage;
    private String commissionAmount;
    private String TotalIncentive;
    private String TotalLKR;
    private String CeilingOrFloorCommission;
    private String TotalToCustomer;
    private String ReceivedAmount;
    private String RefundAmount;
    private String Remarks;
    private String PreviousReceiptNo;
    private String benename;
    private String benecountry;
    private String benebank;
    private String branchCode;
    private String referenceNo;
    private String form12No;
    private String ipAddress;
    private String hostname;
    private String user;
    private String prdCode;
    private String accNo;
    private String userTill;
    private String timestamp; 
    private String status;
    private String reason;
    private String cancelleduser;
    private String cancelledtimestamp;
    private String authreason;
    private String authuser;

    
    
    
      public void setDefaultRate1(String defaultRate1) {
        this.defaultRate1 = defaultRate1;
    }

    public void setDefaultRate2(String defaultRate2) {
        this.defaultRate2 = defaultRate2;
    }

    public void setDefaultRate3(String defaultRate3) {
        this.defaultRate3 = defaultRate3;
    }
    
    public void setAirTicketNo(String airticketno) {
        this.airticketno = airticketno;
    }

    public void setDefaultRate4(String defaultRate4) {
        this.defaultRate4 = defaultRate4;
    }
     public String getDefaultRate1() {
        return defaultRate1;
    }

    public String getDefaultRate2() {
        return defaultRate2;
    }

    public String getDefaultRate3() {
        return defaultRate3;
    }

    public String getDefaultRate4() {
        return defaultRate4;
    }
    public String getAuthreason() {
        return authreason;
    }

    public void setAuthreason(String authreason) {
        this.authreason = authreason;
    }
    

    public String getAuthuser() {
        return authuser;
    }
    public String getAirTicketNo() {
        return airticketno;
    }

    public void setAuthuser(String authuser) {
        this.authuser = authuser;
    }

    public String getAuthtimestamp() {
        return authtimestamp;
    }

    public void setAuthtimestamp(String authtimestamp) {
        this.authtimestamp = authtimestamp;
    }
    private String authtimestamp;

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getCancelleduser() {
        return cancelleduser;
    }

    public void setCancelleduser(String cancelleduser) {
        this.cancelleduser = cancelleduser;
    }

    public String getCancelledtimestamp() {
        return cancelledtimestamp;
    }

    public void setCancelledtimestamp(String cancelledtimestamp) {
        this.cancelledtimestamp = cancelledtimestamp;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }

    public String getReason() {
        return reason;
    }

    public void setReason(String reason) {
        this.reason = reason;
    }
    

    public String getPreviousReceiptNo() {
        return PreviousReceiptNo;
    }

    public void setPreviousReceiptNo(String PreviousReceiptNo) {
        this.PreviousReceiptNo = PreviousReceiptNo;
    }

    public String getRemarks() {
        return Remarks;
    }

    public void setRemarks(String Remarks) {
        this.Remarks = Remarks;
    }

    public String getReceivedAmount() {
        return ReceivedAmount;
    }

    public void setReceivedAmount(String ReceivedAmount) {
        this.ReceivedAmount = ReceivedAmount;
    }

    public String getRefundAmount() {
        return RefundAmount;
    }

    public void setRefundAmount(String RefundAmount) {
        this.RefundAmount = RefundAmount;
    }
    

    public String getCommissionPercentage() {
        return commissionPercentage;
    }

    public void setCommissionPercentage(String commissionPercentage) {
        this.commissionPercentage = commissionPercentage;
    }

    public String getCommissionAmount() {
        return commissionAmount;
    }

    public void setCommissionAmount(String commissionAmount) {
        this.commissionAmount = commissionAmount;
    }

    public String getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(String timestamp) {
        this.timestamp = timestamp;
    }

    public String getIncentiveAmount1() {
        return IncentiveAmount1;
    }

    public void setIncentiveAmount1(String IncentiveAmount1) {
        this.IncentiveAmount1 = IncentiveAmount1;
    }

    public String getIncentiveAmount2() {
        return IncentiveAmount2;
    }

    public void setIncentiveAmount2(String IncentiveAmount2) {
        this.IncentiveAmount2 = IncentiveAmount2;
    }

    public String getIncentiveAmount3() {
        return IncentiveAmount3;
    }

    public void setIncentiveAmount3(String IncentiveAmount3) {
        this.IncentiveAmount3 = IncentiveAmount3;
    }

    public String getIncentiveAmount4() {
        return IncentiveAmount4;
    }

    public void setIncentiveAmount4(String IncentiveAmount4) {
        this.IncentiveAmount4 = IncentiveAmount4;
    }

    public String getTotalIncentive() {
        return TotalIncentive;
    }

    public void setTotalIncentive(String TotalIncentive) {
        this.TotalIncentive = TotalIncentive;
    }

    public String getTotalLKR() {
        return TotalLKR;
    }

    public void setTotalLKR(String TotalLKR) {
        this.TotalLKR = TotalLKR;
    }

    public String getCeilingOrFloorCommission() {
        return CeilingOrFloorCommission;
    }

    public void setCeilingOrFloorCommission(String CeilingOrFloorCommission) {
        this.CeilingOrFloorCommission = CeilingOrFloorCommission;
    }

   

    public String getTotalToCustomer() {
        return TotalToCustomer;
    }

    public void setTotalToCustomer(String TotalToCustomer) {
        this.TotalToCustomer = TotalToCustomer;
    }

    public String getUserTill() {
        return userTill;
    }

    public void setUserTill(String userTill) {
        this.userTill = userTill;
    }
   
    public String getPrdCode() {
        return prdCode;
    }

    public void setPrdCode(String prdCode) {
        this.prdCode = prdCode;
    }
    
    public String getTransactionType() {
        return transactionType;
    }

    public void setTransactionType(String transactionType) {
        this.transactionType = transactionType;
    }

    public String getAccNo() {
        return accNo;
    }

    public void setAccNo(String accNo) {
        this.accNo = accNo;
    }

    public String getUinnumber() {
        return uinnumber;
    }

    public void setUinnumber(String uinnumber) {
        this.uinnumber = uinnumber;
    }

    public String getUincode() {
        return uincode;
    }

    public void setUincode(String uincode) {
        this.uincode = uincode;
    }

    public String getAccountNo() {
        return accountNo;
    }

    public void setAccountNo(String accountNo) {
        this.accountNo = accountNo;
    }

    public String getPassportNo() {
        return passportNo;
    }

    public void setPassportNo(String passportNo) {
        this.passportNo = passportNo;
    }

    public String getNatureOfTxnCode() {
        return natureOfTxnCode;
    }

    public void setNatureOfTxnCode(String natureOfTxnCode) {
        this.natureOfTxnCode = natureOfTxnCode;
    }

    public String getFname() {
        return fname;
    }

    public void setFname(String fname) {
        this.fname = fname;
    }

    public String getCustaddr1() {
        return custaddr1;
    }

    public void setCustaddr1(String custaddr1) {
        this.custaddr1 = custaddr1;
    }

    public String getCustaddr2() {
        return custaddr2;
    }

    public void setCustaddr2(String custaddr2) {
        this.custaddr2 = custaddr2;
    }

    public String getCustaddr3() {
        return custaddr3;
    }

    public void setCustaddr3(String custaddr3) {
        this.custaddr3 = custaddr3;
    }

    public String getCusname() {
        return cusname;
    }

    public void setCusname(String cusname) {
        this.cusname = cusname;
    }

    public String getItrscode() {
        return itrscode;
    }

    public void setItrscode(String itrscode) {
        this.itrscode = itrscode;
    }

    public String getAccounttypecode() {
        return accounttypecode;
    }

    public void setAccounttypecode(String accounttypecode) {
        this.accounttypecode = accounttypecode;
    }

    public String getSectorcode() {
        return sectorcode;
    }

    public void setSectorcode(String sectorcode) {
        this.sectorcode = sectorcode;
    }

    public String getMajorcountry() {
        return majorcountry;
    }

    public void setMajorcountry(String majorcountry) {
        this.majorcountry = majorcountry;
    }

    public String getIcurrencyselector1() {
        return icurrencyselector1;
    }

    public void setIcurrencyselector1(String icurrencyselector1) {
        this.icurrencyselector1 = icurrencyselector1;
    }

    public String getIcurrencyselector2() {
        return icurrencyselector2;
    }

    public void setIcurrencyselector2(String icurrencyselector2) {
        this.icurrencyselector2 = icurrencyselector2;
    }

    public String getIcurrencyselector3() {
        return icurrencyselector3;
    }

    public void setIcurrencyselector3(String icurrencyselector3) {
        this.icurrencyselector3 = icurrencyselector3;
    }

    public String getIcurrencyselector4() {
        return icurrencyselector4;
    }

    public void setIcurrencyselector4(String icurrencyselector4) {
        this.icurrencyselector4 = icurrencyselector4;
    }

    public String getRate1() {
        return rate1;
    }

    public void setRate1(String rate1) {
        this.rate1 = rate1;
    }

    public String getRate2() {
        return rate2;
    }

    public void setRate2(String rate2) {
        this.rate2 = rate2;
    }

    public String getRate3() {
        return rate3;
    }

    public void setRate3(String rate3) {
        this.rate3 = rate3;
    }

    public String getRate4() {
        return rate4;
    }

    public void setRate4(String rate4) {
        this.rate4 = rate4;
    }

    public String getTamount1() {
        return tamount1;
    }

    public void setTamount1(String tamount1) {
        this.tamount1 = tamount1;
    }

    public String getTamount2() {
        return tamount2;
    }

    public void setTamount2(String tamount2) {
        this.tamount2 = tamount2;
    }

    public String getTamount3() {
        return tamount3;
    }

    public void setTamount3(String tamount3) {
        this.tamount3 = tamount3;
    }

    public String getTamount4() {
        return tamount4;
    }

    public void setTamount4(String tamount4) {
        this.tamount4 = tamount4;
    }

    public String getCamount1() {
        return camount1;
    }

    public void setCamount1(String camount1) {
        this.camount1 = camount1;
    }

    public String getCamount2() {
        return camount2;
    }

    public void setCamount2(String camount2) {
        this.camount2 = camount2;
    }

    public String getCamount3() {
        return camount3;
    }

    public void setCamount3(String camount3) {
        this.camount3 = camount3;
    }

    public String getCamount4() {
        return camount4;
    }

    public void setCamount4(String camount4) {
        this.camount4 = camount4;
    }

    public String getUsdCrossRate1() {
        return usdCrossRate1;
    }

    public void setUsdCrossRate1(String usdCrossRate1) {
        this.usdCrossRate1 = usdCrossRate1;
    }

    public String getUsdCrossRate2() {
        return usdCrossRate2;
    }

    public void setUsdCrossRate2(String usdCrossRate2) {
        this.usdCrossRate2 = usdCrossRate2;
    }

    public String getUsdCrossRate3() {
        return usdCrossRate3;
    }

    public void setUsdCrossRate3(String usdCrossRate3) {
        this.usdCrossRate3 = usdCrossRate3;
    }

    public String getUsdCrossRate4() {
        return usdCrossRate4;
    }

    public void setUsdCrossRate4(String usdCrossRate4) {
        this.usdCrossRate4 = usdCrossRate4;
    }

    public String getUsdEqvAmount1() {
        return usdEqvAmount1;
    }

    public void setUsdEqvAmount1(String usdEqvAmount1) {
        this.usdEqvAmount1 = usdEqvAmount1;
    }

    public String getUsdEqvAmount2() {
        return usdEqvAmount2;
    }

    public void setUsdEqvAmount2(String usdEqvAmount2) {
        this.usdEqvAmount2 = usdEqvAmount2;
    }

    public String getUsdEqvAmount3() {
        return usdEqvAmount3;
    }

    public void setUsdEqvAmount3(String usdEqvAmount3) {
        this.usdEqvAmount3 = usdEqvAmount3;
    }

    public String getUsdEqvAmount4() {
        return usdEqvAmount4;
    }

    public void setUsdEqvAmount4(String usdEqvAmount4) {
        this.usdEqvAmount4 = usdEqvAmount4;
    }

    public String getBenename() {
        return benename;
    }

    public void setBenename(String benename) {
        this.benename = benename;
    }

    public String getBenecountry() {
        return benecountry;
    }

    public void setBenecountry(String benecountry) {
        this.benecountry = benecountry;
    }

    public String getBenebank() {
        return benebank;
    }

    public void setBenebank(String benebank) {
        this.benebank = benebank;
    }

    public String getBranchCode() {
        return branchCode;
    }

    public void setBranchCode(String branchCode) {
        this.branchCode = branchCode;
    }

    public String getReferenceNo() {
        return referenceNo;
    }

    public void setReferenceNo(String referenceNo) {
        this.referenceNo = referenceNo;
    }

    public String getForm12No() {
        return form12No;
    }

    public void setForm12No(String form12No) {
        this.form12No = form12No;
    }

    public String getIpAddress() {
        return ipAddress;
    }

    public void setIpAddress(String ipAddress) {
        this.ipAddress = ipAddress;
    }

    public String getHostname() {
        return hostname;
    }

    public void setHostname(String hostname) {
        this.hostname = hostname;
    }

    public String getUser() {
        return user;
    }

    public void setUser(String user) {
        this.user = user;
    }
    
    
}
