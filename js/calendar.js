/***************************************************************************************************
 * �f�U�C���ݒ�^�K�v�ɉ����ďC�����Ă��������B
 ***************************************************************************************************/

var wlock   = 1;             // ��ɑS�ʕ\���̏ꍇ�� 1�A�����łȂ��ꍇ�� 0
var clear_f = 0;             // 1:�N���A�{�^���\���A0:��\��
var c_body  = '#ddddff';     // �{�f�B�̔w�i
var c_table = '#dddddd';     // �J�����_�[�̔w�i
var c_month = '#003399';     // ���̔w�i
var f_month = '#ffffff';     // ���̕���
var c_week  = '#a6c2ff';     // �T�̔w�i
var f_week  = '#000000';     // �T�̕���
var c_date  = '#ffffff';     // ���̔w�i
var c_datex = '#eeeeee';     // ���̔w�i(�挎�E��������)
var c_dateo = '#a6c2ff';     // ���̔w�i(�{������)
var f_date  = '#000000';     // ���̕���
var s_date  = '#ffccff';     // �x�j���̔w�i
var t_date  = '#ccffcc';     // �y�j���̔w�i

/***************************************************************************************************
 * �ݒ�͂����܂�
 ***************************************************************************************************/

/***************************************************************************************************
 *                     �J�����_�[�ɂ����t���̓X�N���v�g calendar.js
 * =================================================================================================
 *                                 The original version
 *                  Copyright(c)1999 Toshirou Takahashi tato@fureai.or.jp
 *                 Support http://www.fureai.or.jp/~tato/JS/BOOK/INDEX.HTM
 * =================================================================================================
 *
 * �y�X�V�L�^�z
 * 2002. 2.22 (��)�u�����v�N���b�N�������ɓ����̓��������ɑ��݂��Ȃ��ꍇ�ɗ����J�����_�[�����������Ȃ�(Thanx TEC�ւ���)
 * 2002. 2.21 �u�����v�N���b�N�������ɓ����̓��������ɑ��݂��Ȃ��ꍇ�ɗ����J�����_�[�����������Ȃ�(Thanx TEC�ւ���)
 * 2002. 2.21 Moz�p�T�C�Y������
 * 2002. 1.28 1�����̑O����12�����̗����O���[���t���N���b�N�œ��N�̏o�͂ɂȂ��Ă����̂��C��(Thanx �g�엝�󂳂�)
 * 2001.12.28 �����֖߂�uO�v�{�^���ŃG���[���o�Ă����̂��C�� ( for WinIE6.0 )
 *
 * =================================================================================================
 *                                The reconstruction version
 *                         Created by Yoshio Kanaya on April 2, 2004
 *                                 http://www.kanaya440.com/
 * =================================================================================================
 *
 * �y�X�V�L�^�z
 * 2008. 6. 8 �u���E�U�ɂ���ĔN���������\������Ȃ��_���C���i for Firefox �j
 * 2007. 4. 5 2007�N�j���@�����ɑΉ�
 * 2005. 7.30 �N���A�{�^���̕\���A��\�����w��ł���悤�ɂ���
 * 2005. 7.19 �N���A�@�\�̒ǉ��i���X�ؗl�ɂ��@�\�ǉ��j
 * 2005. 7.19 �N���ߋ��ɂ��Ă�����1898�N�ȍ~�����������Ȃ�o�O���C���i���X�ؗl�ɂ�邲�w�E�A�C���j
 * 2004. 6.22 Firefox�ɑΉ�����悤�ɂ���
 *
 * Toshirou Takahashi���쐬�̃X�N���v�g������
 *�y�������e�z
 * �EFirefox�ɑΉ��i�T�C�Y�����j
 * �ENS�̏ꍇ���N���b�N�������΂ɃE�B���h�E�\�������悤�ɂ���
 * �E�X�N���[���̏�ɂł�ꍇ�͉��ɁA�X�N���[���E�ɏo��ꍇ�͍��ɕ\�������悤�ɂ���
 * �E�J���[�̃J�X�^�}�C�Y���ȈՁi�ϐ����j�ɂ���
 * �E���ړ������łȂ��A�N�ړ����ł���悤�ɂ���
 * �E�y���j�Փ��̔w�i�F��ς���悤�ɂ���      ���t���̓��E�H���̓��E�����ɋx���ɂ��Ή�
 * �E�}�E�X�I�[�o�[�ŏj������\������悤�ɂ��鄣
 * �E�߂�l�̔N�����̏����w����\�ɂ���
 *   ���t�^�C�v : 'g'    �� �N���̓�������Ԃ��܂� (M�AT�AS�AH)
 *                'gg'   �� �N���̐擪�� 1 �����������ŕԂ��܂� (���A��A���A��)
 *                'ggg'  �� �N����Ԃ��܂� (�����A�吳�A���a�A����)
 *                'yy'   �� ����̔N���� 2 ���̐��l�ŕԂ��܂� (00 �` 99)
 *                'yyyy' �� ����̔N�� 4 ���̐��l�ŕԂ��܂� (100 �` 9999)
 *                'm'    �� ����\�����l��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂��� (1 �` 12)
 *                'mm'   �� ����\�����l��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂� (01 �` 12)
 *                'd'    �� ���t��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂��� (1 �` 31)
 *                'dd'   �� ���t��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂� (01 �` 31)
 *                'w'    �� �j�����p�� (�ȗ��`) �ŕԂ��܂� (Sun �` Sat)
 *                'ww    �� �j�����p��ŕԂ��܂� (Sunday �` Saturday)
 *                'a     �� �j������{�� (�ȗ��`) �ŕԂ��܂� (���`�y)
 *                'aa    �� �j������{��ŕԂ��܂� (���j���`�y�j��)
 *
 *   ���f�t�H���g�́A'yyyy/mm/dd'
 *
 * =================================================================================================
 *
 *  Syntax  : wrtCalendar( event,formElementObject[,formFlg][,moveMonthFlg][,winOpenFlg] )
 *
 *  Example : ��t��:<input type="text" name="e1"><input type="button"
 *                          name="Calendar" value="Calendar"
 *                          onClick="wrtCalendar(event,this.form.e1)">
 *
 *      ��1 : wrtCalendar(event,this.form.e1)
 *      ��2 : wrtCalendar(event,this.form.e1,'yyyy/mm/dd')
 *      ��3 : wrtCalendar(event,this.form.e1,'yyyy�Nm��d��(ww)')
 *      ��4 : wrtCalendar(event,this.form.e1,'gg�Nm��d��(aa)')
 *      ��5 : wrtCalendar(event,this.form.e1,'m/d')
 *      ��6 : wrtCalendar(event,this.form.e1,'mm/dd')
 *
 ***************************************************************************************************/

var now    = new Date();
var absnow = now;
var Win=navigator.userAgent.indexOf('Win')!=-1;
var Mac=navigator.userAgent.indexOf('Mac')!=-1;
var X11=navigator.userAgent.indexOf('X11')!=-1;
var Moz=navigator.userAgent.indexOf('Gecko')!=-1;
var Fir=navigator.userAgent.indexOf('Firefox')!=-1;
var Opera=!!window.opera;
var winflg=1;

function wrtCalendar(e,oj,flg,arg1,arg2){

  if(Opera)return;
  oj.blur();

  if(!arguments[2]) flg  = 'yyyy/mm/dd';
  if(!arguments[3]) arg1 = 0;
  if(!Moz)
  if(arguments[4]||arguments[4]==0) winflg = 0;

  //-������
  if(arg1==0)now = new Date();

  //-�N�����擾
  nowdate  = now.getDate();
  nowmonth = now.getMonth();
  nowyear  = now.getFullYear();

  //-���ړ�����
  if(arg1 == 12){                        //arg1��12�Ȃ�
    nowyear++;                                //1�N���Z
  } else if(arg1 == -12){                 //arg1��-12�Ȃ�
    nowyear--;                                //1�N���Z
  } else if(nowmonth == 11 && arg1 > 0){ //12����arg1��+�Ȃ�
    nowmonth = -1 + arg1; nowyear++;          //����arg1-1;1�N���Z
  } else if(nowmonth == 0 && arg1 < 0){  //1����arg1��-�Ȃ�
    nowmonth = 12 + arg1; nowyear--;          //����arg1+12;1�N���Z
  } else {                               //2-11���Ȃ�
    nowmonth +=  arg1;                        //����+arg1
  }

  //-2000�N���Ή�
  if(nowyear < 1900) nowyear = 1900 + nowyear;

  //-���݌����m��
  now = new Date(nowyear,nowmonth,1);

  //-YYYYMM�쐬
  nowyyyymm = nowyear * 100 + nowmonth;

  //-YYYY/MM�쐬
  nowtitlemonth = nowmonth + 1;
  if(nowtitlemonth < 10) nowtitlemonth = '0' + nowtitlemonth
  nowtitleyyyymm = nowyear + ' / ' + nowtitlemonth;

  //-�T�ݒ�
  week = new Array('��','��','��','��','��','��','�y');

  //-�J�����_�[�\���p�T�u�E�C���h�E�I�[�v��
  if(winflg){

    var w = 160;
    var h = 156;
    if(clear_f) h = 160;

    //-calendar�pOS�ʃT�C�Y������
    if(Fir)     { w += 60; h += 15; }
    else if(Moz){ w += 25; h += 30; }
    else if(Win){ w +=  0; h +=  0; }
    else if(Mac){ w +=  8; h += 22; }
    else if(X11){ w +=  5; h += 46; }

    var x = 100;
    var y = 20;

    //-�\���ʒu����
    if(document.all){
        //e4,e5,e6
        x = window.event.screenX + 15;
        if(x + w > screen.width){ x = window.event.screenX - 180; }
        y = window.event.screenY - 180;
        if(y < 0){y = window.event.screenY}

    } else if (document.layers || document.getElementById){
        //n4,n6,n7,m1,o6
        x = e.screenX + 10;
        if(x + w > screen.width){ x = e.screenX - 200; }
        y = e.screenY - 200;
        if(y < 0){y = e.screenY; }

    }

    //-�J�����_�[�E�B���h�E��\��
    mkSubWin('#','calendar',x,y,w,h);

  }
  //-�J�����_�[�\�z�p����̎擾
  fstday   = now;                                                 //������1��
  startday = fstday - ( fstday.getDay() * 1000 * 60 * 60 * 24 );  //�ŏ��̓��j��
  startday = new Date(startday);

  //-�J�����_�[�\�z�pHTML
  ddata = '';
  ddata += '<html>\n';
  ddata += '<head>';
  ddata += '<meta http-equiv="Content-Type" content="text/html;charset=SHIFT_JIS">\n';
  ddata += '<title>CALENDAR</title>\n';
  ddata += '<style>\n';
  ddata += '  body { font:12px ; line-height:12px ; margin:7px }\n';
  ddata += '  th   { font:14px ; line-height:14px ; font-weight:900 }\n';
  ddata += '  td   { font:12px ; font-family:Arial; line-height:12px }\n';
  ddata += '  a    { text-decoration:none; color:#000000; font:12px; font-family:Arial; line-height:12px }\n';
if(!Moz || Fir){
  ddata += '  input{ font:10px ; font-family:Arial; line-height:10px ; padding:0px }\n';
}
  ddata += '</style>\n';
  ddata += '</head>\n';
  if(wlock){
    ddata += '<body bgcolor="' + c_body + '" onBlur="window.focus()">\n';
  }else{
    ddata += '<body bgcolor="' + c_body + '">\n';
  }

  ddata += '<form>\n';
  ddata += '  <table border="0" bgcolor="' + c_table + '" bordercolor="' + c_table + '" width="140" height="140">\n';

  //-YEAR/MONTH
  ddata += '    <tr id="trmonth" bgcolor="' + c_month + '" bordercolor="' + c_month + '" width="140" height="14">\n';
  ddata += '      <th colspan="7" width="140" height="14" align="right"><nobr><font color="' + f_month + '">';
  ddata +=          nowtitleyyyymm + '\n';

  ddata += '        <input type="button" value="<<" ';
  ddata +=                'onClick="self.opener.wrtCalendar(0,self.opener.document.';
  ddata +=                 oj.form.name+'.'+oj.name+',\''+flg+'\',-12,0)"><input \n';

  ddata += '               type="button" value="<" ';
  ddata +=                'onClick="self.opener.wrtCalendar(0,self.opener.document.';
  ddata +=                 oj.form.name+'.'+oj.name+',\''+flg+'\',-1,0)"><input \n';

  ddata += '               type=button VALUE="O" ';
  ddata +=                'onClick="self.opener.wrtCalendar(0,self.opener.document.';
  ddata +=                 oj.form.name+'.'+oj.name+',\''+flg+'\',0,0)"><input \n';

  ddata += '               type=button VALUE=">" ';
  ddata +=                'onClick="self.opener.wrtCalendar(0,self.opener.document.';
  ddata +=                 oj.form.name+'.'+oj.name+',\''+flg+'\',1,0)"><input \n';

  ddata += '               type=button VALUE=">>" ';
  ddata +=                'onClick="self.opener.wrtCalendar(0,self.opener.document.';
  ddata +=                 oj.form.name+'.'+oj.name+',\''+flg+'\',12,0)">\n';

  ddata += '      </font></nobr></th>\n';
  ddata += '    </tr>\n';

  //-WEEK
  ddata += '    <tr bgcolor="' + c_week + '" width="140" height="14">\n';

  for (i=0;i<7;i++){
    ddata += '      <th width="14" height="14"><font color="' + f_week + '">';
    ddata +=          week[i];
    ddata +=       '</font></th>\n';
  }
  ddata += '    </tr>\n';

  //-DATE
  for(j=0;j<6;j++){
    ddata += '    <tr bgcolor="' + c_date + '">\n';
    for(i=0;i<7;i++){
      nextday = startday.getTime() + (i * 1000 * 60 * 60 * 24);
      wrtday  = new Date(nextday);

      wrtdate     = wrtday.getDate();
      wrtmonth    = wrtday.getMonth();
      wrtyear     = wrtday.getFullYear();
      if(wrtyear < 1900) wrtyear = 1900 + wrtyear;
      wrtyyyymm   = wrtyear * 100 + wrtmonth;

      wrtyyyymmdd = makeDate(flg,wrtyear,wrtmonth,wrtdate,i);

      wrtdateA  = '<a href="javascript:function v(){';
      wrtdateA += '   self.opener.document.' + oj.form.name;
      wrtdateA += '.' + oj.name + '.value=(\'' + wrtyyyymmdd + '\'); self.close()}; v()"';
      wrtdateA += '>';
      wrtdateA += '<font color="' + f_date + '">';
      wrtdateA += wrtdate;
      wrtdateA += '</font>';
      wrtdateA += '</a>';

      if(wrtyyyymm != nowyyyymm){
        ddata += '      <td bgcolor="' + c_datex + '" width="14" height="14" align="center" valign="middle">';
        ddata += wrtdateA;

      } else if( wrtdate  == absnow.getDate()  &&
                 wrtmonth == absnow.getMonth() &&
                 wrtday.getFullYear() == absnow.getFullYear()){
        ddata += '      <td bgcolor="' + c_dateo + '" width="14" height="14" align="center" valign="middle">';
        ddata += wrtdateA;
        if(i == 1) ++moncnt;    // ���j�����J�E���g����

      } else {
        // �j���̎擾
        syuku = getNationalHoliday(wrtyear,wrtmonth + 1,wrtdate,i);
        ddata += '      <td ';
        if(syuku || !i) ddata += 'bgcolor="'+s_date+'" ';       // ���j��
        if(!syuku && i == 6) ddata += 'bgcolor="'+t_date+'" ';  // �y�j��
        ddata += 'width="14" height="14" align="center" valign="middle">';
        if(syuku){
          ddata += '<span title="'+ syuku + '">' + wrtdateA + '</span>';
        }else{
          ddata += wrtdateA;
        }
      }
      ddata += '</td>\n';
    }
    ddata += '    </tr>\n';

    startday = new Date(nextday);
    startday = startday.getTime() + (1000 * 60 * 60 * 24);
    startday = new Date(startday);
  }

  //-mac�p�N���[�Y�{�^��
  if(Mac){
    ddata += '    <tr>\n';
    ddata += '      <td colspan="7" align="center">';
    ddata +=         '<input type="button" value="CLOSE" ';
    ddata +=                'onClick="self.close();return false">';
    ddata +=       '</td>\n';
    ddata += '    </tr>\n';
  }

  ddata += '  </table>\n';

  if(clear_f){
// sasaki add start 2005/07/15
      ddata += '<a href="javascript:function v(){';
      ddata += '   self.opener.document.' + oj.form.name;
      ddata += '.' + oj.name + '.value=(\'' + '\'); self.close()}; v()"';
      ddata += '>';
      ddata += '[CLEAR]';
      ddata += '</a>';
// sasaki add end 2005/07/15
  }
  ddata += '</form>\n';

  ddata += '</body>\n';
  ddata += '</html>\n';

  calendarwin.document.write(ddata);
  calendarwin.document.close();
  calendarwin.focus();

  winflg=1;
}

/***************************************************************************************************
 * �ȈՃT�u�E�C���h�E�J��
 *
 *  Syntax : mkSubWin(URL,winName,x,y,w,h)
 *  ��     : mkSubWin(winIndex,'test.htm','win0',100,200,150,300)
 *
 ***************************************************************************************************/

var calendarwin;

function mkSubWin(URL,winName,x,y,w,h){

    var para = ""
             + " left="        +x
             + ",screenX="     +x
             + ",top="         +y
             + ",screenY="     +y
             + ",toolbar="     +0
             + ",location="    +0
             + ",directories=" +0
             + ",status="      +0
             + ",menubar="     +0
             + ",scrollbars="  +0
             + ",resizable="   +1
             + ",innerWidth="  +w
             + ",innerHeight=" +h
             + ",width="       +w
             + ",height="      +h;

    calendarwin=window.open(URL,winName,para);
    calendarwin.focus();

}

/***************************************************************************************************
 * �Փ��̎擾
 *
 *  ���� : year�Amonth�Aday�Aweek
 *
 *  �ߒl : �Փ��̏ꍇ�͍Փ����A�����łȂ����NULL
 *
 ***************************************************************************************************/

var moncnt = 0;
var furi   = 0;
var ck     = 0;
var Syunbunpar1 = new Array(19.8277,20.8357,20.8431,21.8510);  // �t���E�H���̓��t�v�Z�p1980-2099
var Syunbunpar2 = new Array(22.2588,23.2588,23.2488,24.2488);  // �t���E�H���̓��t�v�Z�p1980-2099

function getNationalHoliday(year,month,day,week){
  // �ϐ��̏�����
  syuku = '';
  if(day == 1 && moncnt > 0 && !ck) moncnt = 0;

  // �n�b�s�[�}���f�[�ƐU�֋x��
  if(week == 1){
    if(!ck) ++moncnt;
    // �U�֋x��
    // (2006�N�܂�)�u�����̏j���v�����j���ɂ�����Ƃ��́A���̗������x���Ƃ���B
    if(furi == 1 && year <= 2006){
      syuku = '�U�֋x��';   // �U�փt���O�������Ă�����x��
      furi = 0;
    }
    // ��2���j
    if(moncnt == 2){
      if(month ==  1){ syuku = '���l�̓�'; }    // 1��
      if(month == 10){ syuku = '�̈�̓�'; }    // 10��
    }
    // ��3���j
    if(moncnt == 3){
      if(year >= 2003 && month == 7){ syuku = '�C�̓�'; }   // 7��(2003�`)
      if(year >= 2003 && month == 9){ syuku = '�h�V�̓�'; } // 9��(2003�`)
    }
  }

  // �t���̓��E�H���̓�
  var i,tyear;
  if ((year >= 1851) && (year <= 1899)) i = 0;
  else if ((year >= 1900) && (year <= 1979)) i = 1;
  else if ((year >= 1980) && (year <= 2099)) i = 2;
  else if ((year >= 2100) && (year <= 2150)) i = 3;
  else i = 4;   // �͈͊O
  if(i < 4){
    if(i < 2) tyear = 1983; else tyear = 1980;
    tyear = (year - tyear);
    if(month == 3){      // �t���̓�
      if(day == Math.floor(Syunbunpar1[i] + 0.242194 * tyear - Math.floor((tyear + 0.1)/4))) syuku = '�t���̓�';
    }else if(month == 9){ // �H���̓�
      if(day == Math.floor(Syunbunpar2[i] + 0.242194 * tyear - Math.floor((tyear + 0.1)/4))) syuku = '�H���̓�';
    }
  }

  // ���̑��̏j��
  if(month == 1 && day ==  1){ syuku = '����' ;}            //  1�� 1��
  if(month == 2 && day == 11){ syuku = '�����L�O�̓�'; }    //  2��11��
  if(month == 4 && day == 29 && year <= 2006){ syuku = '�݂ǂ�̓�'; }      //  4��29��(2006�N�܂�)
  if(month == 4 && day == 29 && year >= 2007){ syuku = '���a�̓�'; }        //  4��29��(2007�N����)
  if(month == 5 && day ==  3){ syuku = '���@�L�O��'; }      //  5�� 3��
  if(month == 5 && day ==  4 && year >= 2007){ syuku = '�݂ǂ�̓�'; }      //  5�� 4��(2007�N����)
  if(month == 5 && day ==  5){ syuku = '���ǂ��̓�'; }      //  5�� 5��
  if(month == 11 && day ==  3){ syuku = '�����̓�'; }       // 11�� 3��
  if(month == 11 && day == 23){ syuku = '�ΘJ���ӂ̓�'; }   // 11��23��
  if(month == 12 && day == 23){ syuku = '�V�c�a����'; }     // 12��23��
  if(year < 2003 && month == 7 && day == 20){ syuku = '�C�̓�'; }   // 7��20��(�`2002)
  if(year < 2003 && month == 9 && day == 15){ syuku = '�h�V�̓�'; } //  9��15��(�`2002)

  // �U�֋x��
  // (2007�N����)�u�����̏j���v�����j���ɓ�����Ƃ��́A���̓���ɂ����Ă��̓��ɍł��߂��u�����̏j���v�łȂ������x���Ƃ���B
  if(furi == 1 && syuku == '' && year >= 2007){
    syuku = '�U�֋x��';   // �U�փt���O�������Ă�����x��
    furi = 0;
  }else if(furi == 1 && syuku != '' && year >= 2007){
    furi = 1;             // �U�փt���O�������Ă��ďj���̏ꍇ�͐U�փt���O�𗧂Ă�
  }else if(week == 0 && syuku != ''){
    furi = 1;             // ���j�ŏj���̏ꍇ�͐U�փt���O�𗧂Ă�
  }else{
    furi = 0;
  }

  // �����̋x��(�j���ɋ��܂ꂽ����)
  // (2006�N�܂�)���̑O���y�ї������u�����̏j���v�ł�����i���j���ɂ�������y�ёO���ɋK�肷��x���ɂ�������������B�j�́A�x���Ƃ���B
  // (2007�N����)���̑O���y�ї������u�����̏j���v�ł�����i�u�����̏j���v�łȂ����Ɍ���B�j�́A�x���Ƃ���B
  if((week > 0 && syuku == '' && !ck && year <= 2006) || (syuku == '' && !ck && syuku != '�U�֋x��' && year >= 2007)){
    ck = 1;  //�ċA�Ăяo���ł�����ʂ�Ȃ��悤�ɂ���
    // �O���Ǝ������j�����m�F
    // �P���Ɩ������j���̏ꍇ�͂Ȃ��̂œ��ɂ��͒P���ɂP�𑝌�����
    // �j���̐ݒ�
    bweek = week - 1; if(bweek < 0) bweek = 6;
    aweek = week + 1; if(bweek > 6) bweek = 0;
    if(getNationalHoliday(year,month,day - 1,bweek) && getNationalHoliday(year,month,day + 1,aweek)){
      syuku = '�����̋x��';
    }
    ck = 0;  // �t���O�̏�����
  }

  return syuku;
}

/***************************************************************************************************
 * ���t�̐���
 *
 *  ���� : year�Amonth�Aday�Aweek
 *
 *  �ߒl : �t�H�[�}�b�g���ꂽ���t
 *
 *  ���t�^�C�v : 'g'    �� �N���̓�������Ԃ��܂� (M�AT�AS�AH)
 *               'gg'   �� �N���̐擪�� 1 �����������ŕԂ��܂� (���A��A���A��)
 *               'ggg'  �� �N����Ԃ��܂� (�����A�吳�A���a�A����)
 *               'yy'   �� ����̔N���� 2 ���̐��l�ŕԂ��܂� (00 �` 99)
 *               'yyyy' �� ����̔N�� 4 ���̐��l�ŕԂ��܂� (100 �` 9999)
 *               'm'    �� ����\�����l��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂��� (1 �` 12)
 *               'mm'   �� ����\�����l��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂� (01 �` 12)
 *               'd'    �� ���t��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂��� (1 �` 31)
 *               'dd'   �� ���t��Ԃ��܂��B1 ���̏ꍇ�A�擪�� 0 ���t���܂� (01 �` 31)
 *               'w'    �� �j�����p�� (�ȗ��`) �ŕԂ��܂� (Sun �` Sat)
 *               'ww    �� �j�����p��ŕԂ��܂� (Sunday �` Saturday)
 *               'a     �� �j������{�� (�ȗ��`) �ŕԂ��܂� (���`�y)
 *               'aa    �� �j������{��ŕԂ��܂� (���j���`�y�j��)
 *
 *  ���l : �E���X�N���v�g�ł� 1868/9/8 �ȍ~���u�����v�ƕ\������B
 *
 *         �E����45�N7��30���Ƒ吳���N7��30���͂Ƃ��ɑ��݂���ׁA
 *           ���X�N���v�g�ł� 1912/7/30 �ȍ~���u�吳�v�ƕ\������B
 *
 *         �E�吳15�N12��25���Ə��a���N12��25���͂Ƃ��ɑ��݂���ׁA
 *           ���X�N���v�g�ł� 1926/12/25 �ȍ~���u���a�v�ƕ\������B
 *
 *         �E���������߂鐭�߂ɂ��Ə��a64�N��1��7���܂ŁA�������N��1��8������
 *           ����āA���X�N���v�g�ł� 1989/1/8 �ȍ~���u�����v�ƕ\������B
 *
 ***************************************************************************************************/

function makeDate(inpt,year,month,day,i){
  month++;
  week1 = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  week2 = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
  week3 = new Array('���j��','���j��','�Ηj��','���j��','�ؗj��','���j��','�y�j��');
  week4 = new Array('��','��','��','��','��','��','�y');

  // �N
  if(inpt.match(/g/i)){
    if(year > 1988 && (month + '/' + day) > '1/7'){
      year = year - 1988;
      if(year == 1) year = '��';
      if     (inpt.match(/ggg/i)) year = '����'+ year;
      else if(inpt.match(/gg/i))  year = '��'+ year;
      else if(inpt.match(/g/i))   year = 'H'+ year;
    }else if(year > 1925 && (month + '/' + day) > '12/24'){
      year = year - 1925;
      if(year == 1) year = '��';
      if     (inpt.match(/ggg/i)) year = '���a'+ year;
      else if(inpt.match(/gg/i))  year = '��'+ year;
      else if(inpt.match(/g/i))   year = 'S'+ year;
    }else if(year > 1911 && (month + '/' + day) > '7/29'){
      year = year - 1911;
      if(year == 1) year = '��';
      if     (inpt.match(/ggg/i)) year = '�吳'+ year;
      else if(inpt.match(/gg/i))  year = '��'+ year;
      else if(inpt.match(/g/i))   year = 'T'+ year;
    }else if(year > 1867 && (month + '/' + day) > '9/7'){
      year = year - 1867;
      if(year == 1) year = '��';
      if     (inpt.match(/ggg/i)) year = '����'+ year;
      else if(inpt.match(/gg/i))  year = '��'+ year;
      else if(inpt.match(/g/i))   year = 'M'+ year;
    }
    // �N�̒u������
    inpt = inpt.replace('ggg', year); inpt = inpt.replace('gg', year); inpt = inpt.replace('g', year);

  }else{
    // �N�̒u������
    inpt = inpt.replace('yyyy', year);
    inpt = inpt.replace('yy', (year+'').substr(2, 2));
  }

  // ��
  if(inpt.match(/mm/i)){
    if(month < 10) month = '0' + month;
  }
  // ���̒u������
  inpt = inpt.replace('mm', month); inpt = inpt.replace('m', month);

  // ��
  if(inpt.match(/dd/i)){
    if(day < 10)   day   = '0' + day;
  }
  // ���̒u������
  inpt = inpt.replace('dd', day); inpt = inpt.replace('d', day);

  // �j���̒u������
  if     (inpt.match(/ww/i)) inpt = inpt.replace('ww', week1[i]);
  else if(inpt.match(/w/i))  inpt = inpt.replace('w',  week2[i]);
  else if(inpt.match(/aa/i)) inpt = inpt.replace('aa', week3[i]);
  else if(inpt.match(/a/i))  inpt = inpt.replace('a',  week4[i]);

  return inpt;
}

/***************************************************************************************************/

