<!-- #INCLUDE FILE="INCLUDE/checkSession.ASP" -->
<!-- #INCLUDE FILE="INCLUDE/db.ASP" -->
<!-- #INCLUDE FILE="INCLUDE/dbutil.asp"  -->
<!-- #INCLUDE FILE="INCLUDE/adovbs.inc" -->
<!-- #include file="include/loginchk.asp"  -->
<%

  Dim help_id, help_topic, help_topic_answer, help_cat_id, active, help_tags
  help_id = Request.Form("help_id")
  help_topic = Request.Form("help_topic")
  help_topic_answer = Request.Form("help_topic_answer")
  lang   = Request.Form("lang")
  help_cat_id = Request.Form("help_cat_id")
  active = Request.Form("active")
  help_tags = Request.Form("help_tags")
  meta_tag = Request.Form("meta_tag")
  meta_description = Request.Form("meta_description")
  meta_title = Request.Form("meta_title")
  permalink = Request.Form("permalink")
  extra_cat = Request.form("help_cat_id_1")
  result = -1
  set rs = CreateObject("Adodb.Recordset")
  rs.cursorType = 3
  rs.cursorLocation = 3

  if help_id = "" then
    Response.write "Help ID is BLANK"
	Response.end
  end if

  if help_cat_id = "" then
      Response.write "Help Category ID is BLANK"
	  Response.end
  end if

  help_topic_answer = trim(help_topic_answer)
    l=len(help_topic_answer)

    if Mid(help_topic_answer,1,3)="<p>" AND Mid(help_topic_answer,l-3,4)="</p>" then
    help_topic_answer=Mid(help_topic_answer,4,l-7)
   end if


  sql = "EXEC sp_AdminHelpTopicInsert  " & rquote(help_id) & "," & rquote(help_topic)  & "," & rquote(help_topic_answer) & "," & rquote(help_cat_id) & "," & rquote(active) & "," & rquote(help_tags) & "," & rquote(meta_tag) & "," & rquote(meta_description) & "," & rquote(permalink) & "," & rquote(meta_title) & "," & rquote(lang)
  ' response.write "<!--" & sql & " -->"
  


  rs.open sql,conn
  IF not rs.eof Then
    result =  rs("Result")
    passhelpid = rs("help_id")

  End If
  if result = - 1 Then
     SendBack("Topic already exists!")
     Response.End()
  else

  ' This is fine for all languages since the category topic relationship will not change
	sql = "delete from help_topic_category_v2 where help_id = " & passhelpid
     conn.execute(sql)

    ' Group by help_category_id since there will copies of the same category_id per langauge
	 sql = "insert into help_topic_category_V2 (help_id, help_Cat_id)  ( select "& passhelpid & ", x.help_Cat_id from help_category_V2 x with (nolock) where help_cat_id in (0," & extra_cat & "," & help_cat_id & ") GROUP BY x.help_Cat_id ) "
     conn.execute(sql)

     SendBack("Data update successfully!")
     Response.End()
  end if


  Function SendBack(errMsg)
    response.write "<html><body onload='javascript:document.frm1.submit();'><form action='search_help_topic.asp' name='frm1' method=post>"
    response.write "<input type='hidden' name='error' value='1'><input type='hidden' name='errormsg' value='" & errMsg & "'>"
    for each xitem in request.form
      response.write "<input type='hidden' name='" & xitem & "' value=""" & request.form(xitem) & """>"
    next
    response.write "</form></body></html>"
 End Function
  %>

