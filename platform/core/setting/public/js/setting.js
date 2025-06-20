(() => {
    function t(e) {
        return t = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
            return typeof t
        } : function (t) {
            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
        }, t(e)
    }

    function e() {
        "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */
        e = function () {
            return r
        };
        var r = {},
            n = Object.prototype,
            o = n.hasOwnProperty,
            a = Object.defineProperty || function (t, e, r) {
                t[e] = r.value
            },
            i = "function" == typeof Symbol ? Symbol : {},
            c = i.iterator || "@@iterator",
            l = i.asyncIterator || "@@asyncIterator",
            u = i.toStringTag || "@@toStringTag";

        function s(t, e, r) {
            return Object.defineProperty(t, e, {
                value: r,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }), t[e]
        }
        try {
            s({}, "")
        } catch (t) {
            s = function (t, e, r) {
                return t[e] = r
            }
        }

        function d(t, e, r, n) {
            var o = e && e.prototype instanceof p ? e : p,
                i = Object.create(o.prototype),
                c = new C(n || []);
            return a(i, "_invoke", {
                value: E(t, r, c)
            }), i
        }

        function f(t, e, r) {
            try {
                return {
                    type: "normal",
                    arg: t.call(e, r)
                }
            } catch (t) {
                return {
                    type: "throw",
                    arg: t
                }
            }
        }
        r.wrap = d;
        var h = {};

        function p() {}

        function m() {}

        function v() {}
        var g = {};
        s(g, c, (function () {
            return this
        }));
        var y = Object.getPrototypeOf,
            b = y && y(y(L([])));
        b && b !== n && o.call(b, c) && (g = b);
        var w = v.prototype = p.prototype = Object.create(g);

        function x(t) {
            ["next", "throw", "return"].forEach((function (e) {
                s(t, e, (function (t) {
                    return this._invoke(e, t)
                }))
            }))
        }

        function $(e, r) {
            function n(a, i, c, l) {
                var u = f(e[a], e, i);
                if ("throw" !== u.type) {
                    var s = u.arg,
                        d = s.value;
                    return d && "object" == t(d) && o.call(d, "__await") ? r.resolve(d.__await).then((function (t) {
                        n("next", t, c, l)
                    }), (function (t) {
                        n("throw", t, c, l)
                    })) : r.resolve(d).then((function (t) {
                        s.value = t, c(s)
                    }), (function (t) {
                        return n("throw", t, c, l)
                    }))
                }
                l(u.arg)
            }
            var i;
            a(this, "_invoke", {
                value: function (t, e) {
                    function o() {
                        return new r((function (r, o) {
                            n(t, e, r, o)
                        }))
                    }
                    return i = i ? i.then(o, o) : o()
                }
            })
        }

        function E(t, e, r) {
            var n = "suspendedStart";
            return function (o, a) {
                if ("executing" === n) throw new Error("Generator is already running");
                if ("completed" === n) {
                    if ("throw" === o) throw a;
                    return T()
                }
                for (r.method = o, r.arg = a;;) {
                    var i = r.delegate;
                    if (i) {
                        var c = k(i, r);
                        if (c) {
                            if (c === h) continue;
                            return c
                        }
                    }
                    if ("next" === r.method) r.sent = r._sent = r.arg;
                    else if ("throw" === r.method) {
                        if ("suspendedStart" === n) throw n = "completed", r.arg;
                        r.dispatchException(r.arg)
                    } else "return" === r.method && r.abrupt("return", r.arg);
                    n = "executing";
                    var l = f(t, e, r);
                    if ("normal" === l.type) {
                        if (n = r.done ? "completed" : "suspendedYield", l.arg === h) continue;
                        return {
                            value: l.arg,
                            done: r.done
                        }
                    }
                    "throw" === l.type && (n = "completed", r.method = "throw", r.arg = l.arg)
                }
            }
        }

        function k(t, e) {
            var r = e.method,
                n = t.iterator[r];
            if (void 0 === n) return e.delegate = null, "throw" === r && t.iterator.return && (e.method = "return", e.arg = void 0, k(t, e), "throw" === e.method) || "return" !== r && (e.method = "throw", e.arg = new TypeError("The iterator does not provide a '" + r + "' method")), h;
            var o = f(n, t.iterator, e.arg);
            if ("throw" === o.type) return e.method = "throw", e.arg = o.arg, e.delegate = null, h;
            var a = o.arg;
            return a ? a.done ? (e[t.resultName] = a.value, e.next = t.nextLoc, "return" !== e.method && (e.method = "next", e.arg = void 0), e.delegate = null, h) : a : (e.method = "throw", e.arg = new TypeError("iterator result is not an object"), e.delegate = null, h)
        }

        function S(t) {
            var e = {
                tryLoc: t[0]
            };
            1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e)
        }

        function j(t) {
            var e = t.completion || {};
            e.type = "normal", delete e.arg, t.completion = e
        }

        function C(t) {
            this.tryEntries = [{
                tryLoc: "root"
            }], t.forEach(S, this), this.reset(!0)
        }

        function L(t) {
            if (t) {
                var e = t[c];
                if (e) return e.call(t);
                if ("function" == typeof t.next) return t;
                if (!isNaN(t.length)) {
                    var r = -1,
                        n = function e() {
                            for (; ++r < t.length;)
                                if (o.call(t, r)) return e.value = t[r], e.done = !1, e;
                            return e.value = void 0, e.done = !0, e
                        };
                    return n.next = n
                }
            }
            return {
                next: T
            }
        }

        function T() {
            return {
                value: void 0,
                done: !0
            }
        }
        return m.prototype = v, a(w, "constructor", {
            value: v,
            configurable: !0
        }), a(v, "constructor", {
            value: m,
            configurable: !0
        }), m.displayName = s(v, u, "GeneratorFunction"), r.isGeneratorFunction = function (t) {
            var e = "function" == typeof t && t.constructor;
            return !!e && (e === m || "GeneratorFunction" === (e.displayName || e.name))
        }, r.mark = function (t) {
            return Object.setPrototypeOf ? Object.setPrototypeOf(t, v) : (t.__proto__ = v, s(t, u, "GeneratorFunction")), t.prototype = Object.create(w), t
        }, r.awrap = function (t) {
            return {
                __await: t
            }
        }, x($.prototype), s($.prototype, l, (function () {
            return this
        })), r.AsyncIterator = $, r.async = function (t, e, n, o, a) {
            void 0 === a && (a = Promise);
            var i = new $(d(t, e, n, o), a);
            return r.isGeneratorFunction(e) ? i : i.next().then((function (t) {
                return t.done ? t.value : i.next()
            }))
        }, x(w), s(w, u, "Generator"), s(w, c, (function () {
            return this
        })), s(w, "toString", (function () {
            return "[object Generator]"
        })), r.keys = function (t) {
            var e = Object(t),
                r = [];
            for (var n in e) r.push(n);
            return r.reverse(),
                function t() {
                    for (; r.length;) {
                        var n = r.pop();
                        if (n in e) return t.value = n, t.done = !1, t
                    }
                    return t.done = !0, t
                }
        }, r.values = L, C.prototype = {
            constructor: C,
            reset: function (t) {
                if (this.prev = 0, this.next = 0, this.sent = this._sent = void 0, this.done = !1, this.delegate = null, this.method = "next", this.arg = void 0, this.tryEntries.forEach(j), !t)
                    for (var e in this) "t" === e.charAt(0) && o.call(this, e) && !isNaN(+e.slice(1)) && (this[e] = void 0)
            },
            stop: function () {
                this.done = !0;
                var t = this.tryEntries[0].completion;
                if ("throw" === t.type) throw t.arg;
                return this.rval
            },
            dispatchException: function (t) {
                if (this.done) throw t;
                var e = this;

                function r(r, n) {
                    return i.type = "throw", i.arg = t, e.next = r, n && (e.method = "next", e.arg = void 0), !!n
                }
                for (var n = this.tryEntries.length - 1; n >= 0; --n) {
                    var a = this.tryEntries[n],
                        i = a.completion;
                    if ("root" === a.tryLoc) return r("end");
                    if (a.tryLoc <= this.prev) {
                        var c = o.call(a, "catchLoc"),
                            l = o.call(a, "finallyLoc");
                        if (c && l) {
                            if (this.prev < a.catchLoc) return r(a.catchLoc, !0);
                            if (this.prev < a.finallyLoc) return r(a.finallyLoc)
                        } else if (c) {
                            if (this.prev < a.catchLoc) return r(a.catchLoc, !0)
                        } else {
                            if (!l) throw new Error("try statement without catch or finally");
                            if (this.prev < a.finallyLoc) return r(a.finallyLoc)
                        }
                    }
                }
            },
            abrupt: function (t, e) {
                for (var r = this.tryEntries.length - 1; r >= 0; --r) {
                    var n = this.tryEntries[r];
                    if (n.tryLoc <= this.prev && o.call(n, "finallyLoc") && this.prev < n.finallyLoc) {
                        var a = n;
                        break
                    }
                }
                a && ("break" === t || "continue" === t) && a.tryLoc <= e && e <= a.finallyLoc && (a = null);
                var i = a ? a.completion : {};
                return i.type = t, i.arg = e, a ? (this.method = "next", this.next = a.finallyLoc, h) : this.complete(i)
            },
            complete: function (t, e) {
                if ("throw" === t.type) throw t.arg;
                return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), h
            },
            finish: function (t) {
                for (var e = this.tryEntries.length - 1; e >= 0; --e) {
                    var r = this.tryEntries[e];
                    if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), j(r), h
                }
            },
            catch: function (t) {
                for (var e = this.tryEntries.length - 1; e >= 0; --e) {
                    var r = this.tryEntries[e];
                    if (r.tryLoc === t) {
                        var n = r.completion;
                        if ("throw" === n.type) {
                            var o = n.arg;
                            j(r)
                        }
                        return o
                    }
                }
                throw new Error("illegal catch attempt")
            },
            delegateYield: function (t, e, r) {
                return this.delegate = {
                    iterator: L(t),
                    resultName: e,
                    nextLoc: r
                }, "next" === this.method && (this.arg = void 0), h
            }
        }, r
    }

    function r(t, e, r, n, o, a, i) {
        try {
            var c = t[a](i),
                l = c.value
        } catch (t) {
            return void r(t)
        }
        c.done ? e(l) : Promise.resolve(l).then(n, o)
    }

    function n(e, r) {
        for (var n = 0; n < r.length; n++) {
            var o = r[n];
            o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, (a = o.key, i = void 0, i = function (e, r) {
                if ("object" !== t(e) || null === e) return e;
                var n = e[Symbol.toPrimitive];
                if (void 0 !== n) {
                    var o = n.call(e, r || "default");
                    if ("object" !== t(o)) return o;
                    throw new TypeError("@@toPrimitive must return a primitive value.")
                }
                return ("string" === r ? String : Number)(e)
            }(a, "string"), "symbol" === t(i) ? i : String(i)), o)
        }
        var a, i
    }
    var o = function () {
        function t() {
            ! function (t, e) {
                if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function")
            }(this, t)
        }
        var o, a, i, c, l;
        return o = t, a = [{
            key: "init",
            value: function () {
                var t = this;
                this.handleMultipleAdminEmails(), $("input[data-key=email-config-status-btn]").on("change", (function (t) {
                    var e = $(t.currentTarget),
                        r = e.prop("id"),
                        n = e.data("change-url");
                    $.ajax({
                        type: "POST",
                        url: n,
                        data: {
                            key: r,
                            value: e.prop("checked") ? 1 : 0
                        },
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : Botble.showSuccess(t.message)
                        },
                        error: function (t) {
                            Botble.handleError(t)
                        }
                    })
                })), $(document).on("change", ".setting-select-options", (function (t) {
                    $(".setting-wrapper").addClass("hidden"), $(".setting-wrapper[data-type=" + $(t.currentTarget).val() + "]").removeClass("hidden")
                })), $(".send-test-email-trigger-button").on("click", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget),
                        r = e.text();
                    e.text(e.data("saving")), $.ajax({
                        type: "POST",
                        url: route("settings.email.edit"),
                        data: e.closest("form").serialize(),
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : (Botble.showSuccess(t.message), $("#send-test-email-modal").modal("show")), e.text(r)
                        },
                        error: function (t) {
                            Botble.handleError(t), e.text(r)
                        }
                    })
                })), $("#send-test-email-btn").on("click", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget);
                    e.addClass("button-loading"), $.ajax({
                        type: "POST",
                        url: route("setting.email.send.test"),
                        data: {
                            email: e.closest(".modal-content").find("input[name=email]").val()
                        },
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : Botble.showSuccess(t.message), e.removeClass("button-loading"), e.closest(".modal").modal("hide")
                        },
                        error: function (t) {
                            Botble.handleError(t), e.removeClass("button-loading"), e.closest(".modal").modal("hide")
                        }
                    })
                })), $(".generate-thumbnails-trigger-button").on("click", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget),
                        r = e.text();
                    e.text(e.data("saving")), $.ajax({
                        type: "POST",
                        url: route("settings.media.post"),
                        data: e.closest("form").serialize(),
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : $("#generate-thumbnails-modal").modal("show"), e.text(r)
                        },
                        error: function (t) {
                            Botble.handleError(t), e.text(r)
                        }
                    })
                })), $("#generate-thumbnails-button").on("click", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget);
                    e.addClass("button-loading"), $.ajax({
                        type: "POST",
                        url: route("settings.media.generate-thumbnails"),
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : Botble.showSuccess(t.message), e.removeClass("button-loading"), e.closest(".modal").modal("hide")
                        },
                        error: function (t) {
                            Botble.handleError(t), e.removeClass("button-loading"), e.closest(".modal").modal("hide")
                        }
                    })
                })), "undefined" != typeof CodeMirror && Botble.initCodeEditor("mail-template-editor"), $(document).on("click", ".btn-trigger-reset-to-default", (function (t) {
                    t.preventDefault(), $("#reset-template-to-default-button").data("target", $(t.currentTarget).data("target")), $("#reset-template-to-default-modal").modal("show")
                })), $(document).on("click", ".js-select-mail-variable", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget),
                        r = $(".CodeMirror")[0].CodeMirror,
                        n = "{{ " + e.data("key") + " }}";
                    if (r.somethingSelected()) r.replaceSelection(n);
                    else {
                        var o = r.getCursor(),
                            a = {
                                line: o.line,
                                ch: o.ch
                            };
                        r.replaceRange(n, a)
                    }
                })), $(document).on("click", ".js-select-mail-function", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget),
                        r = $(".CodeMirror")[0].CodeMirror,
                        n = e.data("sample");
                    if (r.somethingSelected()) r.replaceSelection(n);
                    else {
                        var o = r.getCursor(),
                            a = {
                                line: o.line,
                                ch: o.ch
                            };
                        r.replaceRange(n, a)
                    }
                })), $(document).on("click", "#reset-template-to-default-button", (function (t) {
                    t.preventDefault();
                    var e = $(t.currentTarget);
                    e.addClass("button-loading"), $.ajax({
                        type: "POST",
                        cache: !1,
                        url: e.data("target"),
                        data: {
                            email_subject_key: $("input[name=email_subject_key]").val(),
                            module: $("input[name=module]").val(),
                            template_file: $("input[name=template_file]").val()
                        },
                        success: function (t) {
                            t.error ? Botble.showError(t.message) : (Botble.showSuccess(t.message), setTimeout((function () {
                                window.location.reload()
                            }), 1e3)), e.removeClass("button-loading"), $("#reset-template-to-default-modal").modal("hide")
                        },
                        error: function (t) {
                            Botble.handleError(t), e.removeClass("button-loading")
                        }
                    })
                })), $(document).on("change", ".check-all", (function (t) {
                    var e = $(t.currentTarget),
                        r = e.attr("data-set"),
                        n = e.prop("checked");
                    $(r).each((function (t, e) {
                        n ? $(e).prop("checked", !0) : $(e).prop("checked", !1)
                    }))
                })), $("input.setting-selection-option").each((function (t, e) {
                    var r = $($(e).data("target"));
                    $(e).on("change", (function () {
                        "1" == $(e).val() ? (r.removeClass("d-none"), Botble.initResources()) : r.addClass("d-none")
                    }))
                })), $(document).on("click", ".cronjob #copy-command", (function () {
                    t.copyCommand()
                }))
            }
        }, {
            key: "handleMultipleAdminEmails",
            value: function () {
                var t = $("#admin_email_wrapper");
                if (t.length) {
                    var e = t.find("#add"),
                        r = parseInt(t.data("max"), 10),
                        n = t.data("emails");
                    0 === n.length && (n = [""]);
                    var o = function () {
                            t.find("input[type=email]").length >= r ? e.addClass("disabled") : e.removeClass("disabled")
                        },
                        a = function () {
                            var t = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
                            return e.before('<div class="d-flex mt-2 more-email align-items-center">\n                <input type="email" class="next-input" placeholder="'.concat(e.data("placeholder"), '" name="admin_email[]" value="').concat(t || "", '" />\n                <a class="btn btn-link text-danger"><i class="fas fa-minus"></i></a>\n            </div>'))
                        };
                    t.on("click", ".more-email > a", (function () {
                        $(this).parent(".more-email").remove(), o()
                    })), e.on("click", (function (t) {
                        t.preventDefault(), a(), o()
                    })), n.forEach((function (t) {
                        a(t)
                    })), o()
                }
            }
        }, {
            key: "copyCommand",
            value: (c = e().mark((function t() {
                var r, n, o;
                return e().wrap((function (t) {
                    for (;;) switch (t.prev = t.next) {
                        case 0:
                            if (r = $(".cronjob #command"), n = r.val(), !navigator.clipboard || !window.isSecureContext) {
                                t.next = 8;
                                break
                            }
                            return t.next = 5, navigator.clipboard.writeText(n);
                        case 5:
                            Botble.showSuccess(r.data("copied")), t.next = 15;
                            break;
                        case 8:
                            (o = document.createElement("textarea")).value = n, o.style.position = "absolute", o.style.left = "-999999px", document.body.prepend(o), o.select();
                            try {
                                document.execCommand("copy"), Botble.showSuccess(r.data("copied"))
                            } catch (t) {
                                console.error(t)
                            } finally {
                                o.remove()
                            }
                            case 15:
                            case "end":
                                return t.stop()
                    }
                }), t)
            })), l = function () {
                var t = this,
                    e = arguments;
                return new Promise((function (n, o) {
                    var a = c.apply(t, e);

                    function i(t) {
                        r(a, n, o, i, l, "next", t)
                    }

                    function l(t) {
                        r(a, n, o, i, l, "throw", t)
                    }
                    i(void 0)
                }))
            }, function () {
                return l.apply(this, arguments)
            })
        }], a && n(o.prototype, a), i && n(o, i), Object.defineProperty(o, "prototype", {
            writable: !1
        }), t
    }();
    $(document).ready((function () {
        (new o).init()
    }))
})();
