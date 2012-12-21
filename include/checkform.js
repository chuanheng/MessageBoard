function FrontPage_Form1_Validator(theForm)
{
  if (theForm.username.value == "")
  {
    alert("请填写昵称！");
    theForm.username.focus();
    return (false);
  }
  if (theForm.username.value.length<3)
  {
    alert("昵称至少应为3个字符！");
    theForm.username.focus();
    return (false);
  }
  if(theForm.email.value!=""){
              var email1 = theForm.email.value;
              var pattern = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/; 
              flag = pattern.test(email1); 
              if(!flag){
              alert("邮件地址格式不对！");
     theForm.email.focus();
           return false;}
  }

  if (theForm.content.value == "")
  {
    alert("留言内容不能空！");
    theForm.content.focus();
    return (false);
  }
  if (theForm.content.value.length<5)
  {
    alert("留言内容最少5个字符！");
    theForm.content.focus();
    return (false);
  }
  if (theForm.unum.value == "")
  {
    alert("请输入验证码！");
    theForm.unum.focus();
    return (false);
  }
   return (true);
}