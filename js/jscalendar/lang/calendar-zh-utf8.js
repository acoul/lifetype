// ** I18N

// Calendar ZH language
// Author: muziq, <muziq@sina.com>
// Encoding: GB2312 or GBK
// Distributed under the same terms as the calendar itself.

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
Calendar._TT["INFO"] = "幫助";

Calendar._TT["ABOUT"] =
"DHTML Date/Time Selector\n" +
"(c) dynarch.com 2002-2005 / Author: Mihai Bazon\n" + // don't translate this this ;-)
"For latest version visit: http://www.dynarch.com/projects/calendar/\n" +
"Distributed under GNU LGPL.  See http://gnu.org/licenses/lgpl.html for details." +
"\n\n" +
"選擇日期:\n" +
"- 點擊 \xab, \xbb 按鈕選擇年份\n" +
"- 點擊 " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " 按鈕選擇月份\n" +
"- 長按以上按鈕可從菜單中快速選擇年份或月份";
Calendar._TT["ABOUT_TIME"] = "\n\n" +
"選擇時間:\n" +
"- 點擊小時或分鐘可使改數值加一\n" +
"- 按住Shift鍵點擊小時或分鐘可使改數值減一\n" +
"- 點擊拖動鼠標可進行快速選擇";

Calendar._TT["PREV_YEAR"] = "上一年 (按住出菜單)";
Calendar._TT["PREV_MONTH"] = "上一月 (按住出菜單)";
Calendar._TT["GO_TODAY"] = "轉到今日";
Calendar._TT["NEXT_MONTH"] = "下一月 (按住出菜單)";
Calendar._TT["NEXT_YEAR"] = "下一年 (按住出菜單)";
Calendar._TT["SEL_DATE"] = "選擇日期";
Calendar._TT["DRAG_TO_MOVE"] = "拖動";
Calendar._TT["PART_TODAY"] = " (今日)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Calendar._TT["DAY_FIRST"] = "最左邊顯示%s";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Calendar._TT["WEEKEND"] = "0,6";

Calendar._TT["CLOSE"] = "關閉";
Calendar._TT["TODAY"] = "今日";
Calendar._TT["TIME_PART"] = "(Shift-)點擊鼠標或拖動改變值";

// date formats
Calendar._TT["DEF_DATE_FORMAT"] = "%Y-%m-%d";
Calendar._TT["TT_DATE_FORMAT"] = "%A, %b %e日";

Calendar._TT["WK"] = "周";
Calendar._TT["TIME"] = "時間:";