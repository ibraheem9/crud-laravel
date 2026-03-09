helperJS = function () {
    return {
        consoleLog: function (...args) {
            if (APP_DEBUG) {
                console.log(args);
            }
        },
        // this function used to merge to objects used like helperJS.merge2Objects
        merge2Objects: function (obj1, obj2) {

            // jQuery.extend(true, obj1, obj2);
            for (let p in obj2) {
                try {
                    // Property in destination object set; update its value.
                    obj1[p] = obj2[p];

                } catch (e) {
                    // // Property in destination object not set; create it and set its value.
                    // obj1[p] = obj2[p];

                }
            }
            return obj1;
        },
        isObject: function (obj) {
            return obj != null && obj.constructor.name === "Object"
        },

        delay: function (callback, ms) {
            var timer = 0;
            return function () {
                var context = this, args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function () {
                    callback.apply(context, args);
                }, ms || 0);
            };
        },
        basename: function (str, sep = '/') {
            return str.substr(str.lastIndexOf(sep) + 1);
        },

        getUrlQueryString: function () {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for (var i = 0; i < hashes.length; i++) {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        },


        parseArabic: function (str) {


            let result = str.replace(/[٠١٢٣٤٥٦٧٨٩]/g, function (d) {
                return d.charCodeAt(0) - 1632; // Convert Arabic numbers
            }).replace(/[۰۱۲۳۴۵۶۷۸۹]/g, function (d) {
                return d.charCodeAt(0) - 1776; // Convert Persian numbers
            });


            return result;
        }
        ,
        convertNumbers2English: function (string) {
            return string.replace(/[\u0660-\u0669]/g, function (c) {
                return c.charCodeAt(0) - 0x0660;
            }).replace(/[\u06f0-\u06f9]/g, function (c) {
                return c.charCodeAt(0) - 0x06f0;
            });
        },
        customRound: function (value) {
            let result = null;
            let precision = 2;
            try {
                result = value.toFixed(precision);
            } catch (error) {
                result = value;
            }

            return result;
        },

        redirectTo: function (url) {
            window.location.href = url;
        },

        checkIfObjectsEquivalent: function (a, b) {
            // Create arrays of property names
            var aProps = Object.getOwnPropertyNames(a);
            var bProps = Object.getOwnPropertyNames(b);

            // If number of properties is different,
            // objects are not equivalent
            if (aProps.length != bProps.length) {
                return false;
            }

            for (var i = 0; i < aProps.length; i++) {
                var propName = aProps[i];

                // If values of same property are not equal,
                // objects are not equivalent
                if (a[propName] !== b[propName]) {
                    return false;
                }
            }

            // If we made it this far, objects
            // are considered equivalent
            return true;
        },
        printSectionAsPDF: function (elementId) {
            var printContents = document.getElementById(elementId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            // Use a media query to specify the print styles
            var mediaQuery = window.matchMedia('print');
            mediaQuery.addEventListener('change', function (mql) {
                if (!mql.matches) {
                    // Restore the original contents when not printing
                    document.body.innerHTML = originalContents;
                }
            });

            window.print();
        },
        formatDate: function (date, format = 'd M, Y H:i:s') {
            if (!date) return '---';

            const dateObj = new Date(date);

            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            return dateObj.toLocaleDateString('en-GB', options);
        }

    }
}();
