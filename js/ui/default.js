function externalLinks()
{
    if (!document.getElementsByTagName) return;

    var anchors = document.getElementsByTagName("a");

    for (var i = 0; i < anchors.length; i++)
    {
        var anchor = anchors[i];

        if (anchor.getAttribute("href") && anchor.getAttribute("rel") == "external")
        {
            anchor.target = "_blank";
        }
    }
}

window.onload = externalLinks;

function verifyOneCheckMinimum(formName, msg, prefix)
{
    n = "all";

    if (prefix)
    {
        n = prefix + n;
    }

    f = document.getElementById(formName);
    i = 0;
    j = 0;

    while (e = f.elements[i])
    {
        if (e.type == "checkbox" && e.id != n && e.checked)
        {
            if (!prefix || e.id.indexOf(prefix) != -1)
            {
                j++;
            }
        }

        i++;
    }

    result = (j > 0);

    if (!result && msg)
    {
        alert(msg);
    }

    return result;
}

function submitForm(formName, opValue, msg)
{
    if (msg)
    {
        if (!verifyOneCheckMinimum(formName))
        {
            alert(msg);
            return false;
        }
    }

    f = document.getElementById(formName);
    f.op.value = opValue;
    return true;
}

function toggleAllChecks(formName, prefix)
{
    n = "all";

    if (prefix)
    {
        n = prefix + n;
    }

    i = 0;
    e = document.getElementById(n);
    s = e.checked;
    f = document.getElementById(formName);

    while (e = f.elements[i])
    {
        if (e.type == "checkbox" && e.id != n)
        {
            if (!prefix || e.id.indexOf(prefix) != -1)
            {
                e.checked = s;
            }
        }

        i++;
    }
}

// In LifeType 1.2 imeplemtation, we don't have the Role object.
// So, I just defined two kind of permission group here, it can help user configure thier blog user permission easily.
var permissionSets = new Array();
permissionSets["basic_blog_permission"] = new Array( 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 22, 23, 24, 25, 26, 36, 37 );
permissionSets["full_blog_permission"] = new Array( 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38 );

function togglePermissionSets(formName, permissionSet)
{
	if(permissionSet == "")
		return;

    f = document.getElementById(formName);
	i = 0;
    while (e = f.elements[i])
    {
        if (e.type == "checkbox" && e.id != "sendNotification")
        {
            if( inArray(permissionSets[permissionSet], e.value) )
            	e.checked = 1;
            else
            	e.checked = 0;
        }
        i++;
    }
}

// Returns true if the passed value is found in the
// array. Returns false if it is not.
function inArray(a, v, c)
{
	var i;
	for (i=0; i < a.length; i++) {
		// use === to check for Matches. ie., identical (===),
		if(c){ //performs match even the string is case sensitive
			if (a[i].toLowerCase() == v.toLowerCase()) {
				return true;
			}
		}else{
			if (a[i] == v) {
				return true;
			}
		}
	}
	return false;
}

function confirmDlg(l, msg)
{
    if (confirm(msg))
    {
        if (typeof(l) == 'string')
        {
            document.location.href = l;
        }
        else
        {
            document.location.href = l.href;
        }
    }

    return false;
}

function popUp(l, n, f)
{
    if (!window.focus)
    {
        return true;
    }

    if (typeof(l) == 'string')
    {
        window.open(l, n, f);
    }
    else
    {
        window.open(l.href, n, f);
    }

    return false;
}

function goTo(l)
{
    window.location.href = l;
}

function goToIf(l, msg)
{
    if (confirm(msg))
    {
        window.location.href = l;
    }
}
