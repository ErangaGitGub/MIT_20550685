/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.boc.transfer.repository;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.text.SimpleDateFormat;
import java.util.Calendar;

/**
 *
 * @author it203886
 */
public class WriteFile {
    public static void WriteInfor(String text)
    {
        SimpleDateFormat date_Format = new SimpleDateFormat("yyyy_MM_dd");
  	Calendar cal = Calendar.getInstance();
        String c_date = date_Format.format(cal.getTime());
        String log_f_name="C://Log//ReceiveLog_" + c_date.substring(0,4) + "-" + c_date.substring(5,7) + "-" + c_date.substring(8,10) + ".log";
        
        
        File logfile = new File(log_f_name);
        try
        {			
            FileWriter file = new FileWriter(logfile,true); // Create Log file if not exist 
            BufferedWriter log = new BufferedWriter(file);
            log.write(text);            
            log.write("\r\n");	
            log.close(); //Close the output stream
        }
        catch (Exception e)
        {       
                //LogWrite("Error in Log File: " + e.getMessage());
		System.err.println("Error in Log File: " + e.getMessage());
	}
        
    }
    
    public static String getCurrentDateandTime()
    {
        String msgDate = "";
        try 
        {
            msgDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new java.util.Date());
            //TimeFormatter timeFormatter = new AbsoluteTimeFormatter();
            //String date_time = timeFormatter.format(new Date());
            //msgDate = "20" + date_time.substring(0, 6) + "-" + date_time.substring(6, 8) + ":" + date_time.substring(8, 10) + "." + date_time.substring(10, 12);            
        }
        catch (Exception e)
        {
            System.err.println("Exception in getCurrentDateTime() ");
            WriteFile.WriteInfor("ERR|XXX|19000101-00:00.00|0000|0000|" + e.getLocalizedMessage());
        }
        finally
        {
            return msgDate;
        }
    }
}
