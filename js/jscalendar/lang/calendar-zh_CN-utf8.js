// ** I18N

// Calendar big5-utf8 language
// Author: Gary Fu, <gary@garyfu.idv.tw>
// Encoding: utf8
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.
	
// full day names
Calendar._DN = new Array
("星期日",
 "星期一",
 "星期二",
 "星期三",
 "星期四",
 "星期五",
 "星期六",
 "星期日");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Calendar._SDN_len = N; // short day name length
//   Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Calendar._SDN = new Array
("日",
 "一",
 "二",
 "三",
 "四",
 "五",
 "六",
 "日");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Calendar._FD = 0;

// full month names
Calendar._MN = new Array
("一月",
 "二月",
 "三月",
 "四月",
 "五月",
 "六月",
 "七月",
 "八月",
 "九月",
 "十月",
 "十一月",
 "十二月");

// short month names
Calendar._SMN = new Array
("一月",
 "二月",
 "三月",
 "四月",
 "五月",
 "六月",
 "七月",
 "八月",
 "九月",
 "十月",
 "十一月",
 "十二月");

// tooltips
Calendar._TT = {};
Calendar._TT["INFO"] = "关于";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"日期选择方法:\n" +
"- 使用 \xab, \xbb 按钮可选择年份\n" +
"- 使用 " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " 按钮可选择月份\n" +
"- 按住上面的按钮可以加快选取";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"时间选择方法:\n" +
"- 点击任何的时间部份可增加其值\n" +
"- 同时按Shift键再点击可减少其值\n" +
"- 点击并拖曳可加快改变的值";

Calendar._TT["PREV_YEAR"] = "上一年 (按住选单)";
Calendar._TT["PREV_MONTH"] = "下一年 (按住选单)";
Calendar._TT["GO_TODAY"] = "到今日";
Calendar._TT["NEXT_MONTH"] = "上一月 (按住选单)";
Calendar._TT["NEXT_YEAR"] = "下一月 (按住选单)";
Calendar._TT["SEL_DATE"] = "选择日期";
Calendar._TT["DRAG_TO_MOVE"] = "拖曳";
Calendar._TT["PART_TODAY"] = " (今日)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "将 %s 显示在前";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "关闭";
Calendar._TT["TODAY"] = "今日";
Calendar._TT["TIME_PART"] = "点击or拖曳可改变时间(同时按Shift为减)";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%b %e (%A)";

Calendar._TT["WK"] = "周";
Calendar._TT["TIME"] = "时间：";
