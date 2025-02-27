"use strict";
(() => {
    var z = () => {
        let e = document.querySelectorAll('[data-flyout="toggle"]')
            , r = document.querySelectorAll('[data-flyout="menu"]')
            , n = document.querySelector(".flyout-overlay")
            , o = document.querySelectorAll(".flyout-close")
            , t = 0
            , s = u => {
                if (!u)
                    return;
                u.classList.contains("flyout-menu-open") ? i() : l(u)
            }
            , l = u => {
                a(),
                    u.classList.add("flyout-menu-open"),
                    c(!0)
            }
            , i = () => {
                d(),
                    r.forEach(u => {
                        u.classList.remove("flyout-menu-open")
                    }
                    ),
                    c(!1)
            }
            , c = u => {
                let m = document.querySelector(".flyout-overlay");
                m == null || m.classList.toggle("flyout-overlay-active", u)
            }
            , a = () => {
                t = window.scrollY,
                    document.body.style.top = "-".concat(t, "px"),
                    document.body.classList.add("fixed", "body-locked")
            }
            , d = () => {
                document.body.style.top = "",
                    document.body.classList.remove("fixed", "body-locked"),
                    window.scrollTo(0, t)
            }
            ;
        e.forEach(u => {
            u.addEventListener("click", () => {
                let m = u.getAttribute("data-target");
                if (!m)
                    return;
                let g = document.getElementById(m);
                s(g)
            }
            )
        }
        ),
            n == null || n.addEventListener("click", i),
            o.forEach(u => {
                u.addEventListener("click", i)
            }
            )
    };

    var K = () => {
        let e = document.querySelectorAll(".panel-container")
            , r = n => {
                let o = 0
                    , t = n.querySelectorAll(".panel-next")
                    , s = n.querySelectorAll(".panel-previous")
                    , l = n.querySelector(".main-panel")
                    , i = document.querySelector(".flyout-overlay")
                    , c = document.querySelectorAll(".flyout-close")
                    , a = document.querySelectorAll(".dropdown");
                i == null || i.addEventListener("click", () => d()),
                    c.forEach(g => {
                        g.addEventListener("click", () => d())
                    }
                    ),
                    a.forEach(g => {
                        g.addEventListener("hide.bs.dropdown", () => d())
                    }
                    );
                let d = () => {
                    o = 0,
                        m(),
                        n.style.transform = "translateX(0)",
                        u()
                }
                    , u = () => {
                        var L;
                        let g = n.querySelectorAll(".stacked-panels > .panel");
                        (L = n.querySelector(".dummy-panel")) == null || L.classList.add("active");
                        for (let E of g)
                            E.classList.remove("active")
                    }
                    , m = () => {
                        o > 0 ? l == null || l.classList.add("inactive-main") : l == null || l.classList.remove("inactive-main")
                    }
                    ;
                for (let g of s)
                    g.addEventListener("click", () => {
                        o -= 1,
                            m();
                        let E = getComputedStyle(document.documentElement).direction === "rtl" ? o * 100 : -o * 100;
                        n.style.transform = "translateX(".concat(E, "%)"),
                            u()
                    }
                    );
                for (let g of t)
                    g.addEventListener("click", L => {
                        var H;
                        let E = L.currentTarget.dataset.panelTarget
                            , h = n.querySelector(".panel.".concat(E));
                        if (!h)
                            return;
                        if (o += 1,
                            m(),
                            h && ((H = h.parentElement) != null && H.className.includes("stacked-panels"))) {
                            let R = n.querySelectorAll(".stacked-panels .panel");
                            for (let x of R)
                                x === h ? h.classList.add("active") : x.classList.remove("active")
                        }
                        let y = getComputedStyle(document.documentElement).direction === "rtl" ? o * 100 : -o * 100;
                        n.style.transform = "translateX(".concat(y, "%)")
                    }
                    )
            }
            ;
        for (let n of e)
            r(n)
    };

    var W = () => {
        var o, t;
        let e = (t = (o = document.querySelector("#header .header-container")) == null ? void 0 : o.offsetHeight) != null ? t : 100
            , r = 10
            , n = 0;
        document.addEventListener("scroll", () => {
            window.requestAnimationFrame(() => {
                let s = window.scrollY, l = s - n;
                Math.abs(l) <= r || (n <= e ? document.body.classList.remove("nav-up", "nav-down") : l > 0 ? (document.body.classList.add("nav-up"),
                    document.body.classList.remove("nav-down")) : (document.body.classList.add("nav-down"),
                        document.body.classList.remove("nav-up")),
                    n = s)
            })
        })
    };

    var G = (e, r, n, o = null, t = null) => {
        let s = document.querySelector(e)
            , l = document.querySelector(r);
        if (!s || !l)
            return;
        let i = l.querySelectorAll(n)
            , c = () => o ? Array.from(document.querySelectorAll(o)) : []
            , a = () => {
                let m = s.value || ""
                    , g = new RegExp(m.replace(/[.*+?^${}()|[\]\\]/g, "\\$&"), "i");
                for (let L of i)
                    L.classList.toggle("hidden", (L.textContent || "").search(g) === -1);
                for (let L of c()) {
                    let E = L.querySelectorAll(n + ":not(.hidden)").length === 0;
                    L.classList.toggle("hidden", E);
                    let h = (t || "") + (L.dataset.anchor || "");
                    if (h === "")
                        continue;
                    let v = document.querySelector(h);
                    v && v.classList.toggle("hidden", E)
                }
            }
            , d = () => {
                a(),
                    l.scrollTop = 0
            }
            , u = () => {
                for (let m of i)
                    m.classList.remove("hidden");
                for (let m of c()) {
                    m.classList.remove("hidden");
                    let g = t || "" + m.dataset.anchor || "";
                    if (g === "")
                        continue;
                    let L = document.querySelector(g + m.dataset.anchor);
                    L && L.classList.remove("hidden")
                }
            }
            ;
        s.addEventListener("keyup", d),
            s.addEventListener("search", d),
            s.addEventListener("clear", u)
    };

    function I(e) {
        for (var r = 1; r < arguments.length; r++) {
            var n = arguments[r];
            for (var o in n)
                e[o] = n[o]
        }
        return e
    }

    var ke = {
        read: function (e) {
            return e[0] === '"' && (e = e.slice(1, -1)),
                e.replace(/(%[\dA-F]{2})+/gi, decodeURIComponent)
        },
        write: function (e) {
            return encodeURIComponent(e).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g, decodeURIComponent)
        }
    };

    function O(e, r) {
        function n(t, s, l) {
            if (!(typeof document > "u")) {
                l = I({}, r, l),
                    typeof l.expires == "number" && (l.expires = new Date(Date.now() + l.expires * 864e5)),
                    l.expires && (l.expires = l.expires.toUTCString()),
                    t = encodeURIComponent(t).replace(/%(2[346B]|5E|60|7C)/g, decodeURIComponent).replace(/[()]/g, escape);
                var i = "";
                for (var c in l)
                    l[c] && (i += "; " + c,
                        l[c] !== !0 && (i += "=" + l[c].split(";")[0]));
                return document.cookie = t + "=" + e.write(s, t) + i
            }
        }
        function o(t) {
            if (!(typeof document > "u" || arguments.length && !t)) {
                for (var s = document.cookie ? document.cookie.split("; ") : [], l = {}, i = 0; i < s.length; i++) {
                    var c = s[i].split("=")
                        , a = c.slice(1).join("=");
                    try {
                        var d = decodeURIComponent(c[0]);
                        if (l[d] = e.read(a, d),
                            t === d)
                            break
                    } catch (u) { }
                }
                return t ? l[t] : l
            }
        }
        return Object.create({
            set: n,
            get: o,
            remove: function (t, s) {
                n(t, "", I({}, s, {
                    expires: -1
                }))
            },
            withAttributes: function (t) {
                return O(this.converter, I({}, this.attributes, t))
            },
            withConverter: function (t) {
                return O(I({}, this.converter, t), this.attributes)
            }
        }, {
            attributes: {
                value: Object.freeze(r)
            },
            converter: {
                value: Object.freeze(e)
            }
        })
    }

    var B = O(ke, {
        path: "/"
    });

    var q = e => {
        let r = B.withAttributes({
            expires: e,
            secure: document.location.protocol === "https:",
            sameSite: "Lax"
        });
        return {
            set: r.set,
            get: r.get,
            remove: r.remove,
            setJSON: (n, o, t) => {
                try {
                    o = JSON.stringify(o)
                } catch (s) { }
                return r.set(n, o, t)
            }
            ,
            getJSON: n => {
                let o = r.get(n);
                if (o) {
                    try {
                        o = JSON.parse(o)
                    } catch (t) { }
                    return o
                }
            }
        }
    };

    var Q = e => {
        let r = document.querySelectorAll(e);
        if (!r.length)
            return;
        let n = q(30);
        for (let o of r) {
            let t = o.querySelectorAll(".tag-data");
            if (t.length <= 0)
                return;
            let s = t[0];
            for (let l of s.querySelectorAll("a"))
                l.addEventListener("click", () => {
                    let i = n.getJSON("tag") || {}
                        , c = s.dataset.tagName || "";
                    if (i[c] = l.dataset.tagValue,
                        s.dataset.persistent === "0" && (delete i[c],
                            Object.keys(i).length === 0)) {
                        n.remove("tag");
                        return
                    }
                    n.setJSON("tag", i)
                }
                )
        }
    };

    var Z = e => {
        for (let r of document.querySelectorAll(e))
            r.addEventListener("change", () => {
                let n = r.closest("form");
                n && n.submit()
            }
        )
    };
    
    var ee = e => {
        let r = document.querySelector(e);
        if (!r)
            return;
        let n = r.querySelector(".filter-button-container")
            , o = r.querySelector(".filter-button");
        if (!n)
            return;
        let t = s => {
            let l = 'input[name="filter[' + s + ']"]'
                , i = r.querySelectorAll(l);
            if (i.length === 0)
                return;
            let c = i[0].closest(".content-filter-container")
                , a = r.querySelector(l + ":checked");
            if (!c || !a || a.value.length === 0)
                return;
            o && o.classList.add("is-set"),
                n.querySelectorAll("." + s + "-set").forEach(m => m.classList.add("show"));
            let d = c.querySelector('label[for="' + a.id + '"]')
                , u = (d == null ? void 0 : d.textContent) || "";
            c.querySelectorAll(".content-filter-reset-button").forEach(m => m.classList.add("show")),
                c.classList.add("is-set"),
                c.querySelectorAll(".content-filter-header").forEach(m => m.innerHTML = u)
        }
            ;
        t("advertiser_publish_date"),
            t("duration"),
            t("quality"),
            t("virtual_reality"),
            t("pricing"),
            t("advertiser_site")
    };

    var k = (e, r) => {
        let n = document.querySelector(e);
        if (!n)
            return;
        let o = 'input[name="filter[' + r + ']"]'
            , t = n.querySelectorAll(o);
        if (t.length === 0)
            return;
        let s = t[0].closest(".content-filter-container");
        if (!s)
            return;
        let l = s.querySelector(".content-filter-reset-button")
            , i = t[0];
        !l || !i || l.addEventListener("click", () => {
            i.checked = !0,
                i.dispatchEvent(new Event("change", {
                    bubbles: !0,
                    cancelable: !1
                })),
                s.querySelectorAll("button.dropdown-toggle").forEach(c => c.classList.remove("is-set")),
                l.classList.remove("show")
        }
        )
    };

    var xe = (e, r, n, o, t) => {
        let s = document.createElement("div");
        s.innerHTML = e;
        let l = s.querySelector("input")
            , i = s.querySelector("label");
        return !l || !i ? null : (l.id = l.id.replace(/_0$/, "_" + r),
            l.value = n,
            l.checked = t,
            i.htmlFor = i.htmlFor.replace(/_0$/, "_" + r),
            i.innerHTML = o,
            s.firstElementChild)
    };

    var te = e => {
        var n, o;
        let r = document.querySelector(e);
        if (r)
            for (let t of r.querySelectorAll(".filter-options-partial")) {
                let s = t.querySelector("input")
                    , l = t.querySelector(".filter-options-partial-options")
                    , i = t.querySelector("button.filter-options-partial-more")
                    , c = t.querySelector("template")
                    , a = (n = t.dataset.selected) != null ? n : ""
                    , d = JSON.parse((o = t.dataset.options) != null ? o : "{}");
                if (!s || !l || !i || !c || !d)
                    continue;
                let u = Object.keys(d)
                    , m = 0
                    , g = () => {
                        l.innerHTML = "",
                            i.classList.remove("hidden")
                    }
                    , L = () => {
                        let h = Math.min(m + 12, u.length);
                        for (let v = m; v < h; v++) {
                            let y = u[v]
                                , H = xe(c.innerHTML, v, y, d[y], y === a);
                            H && l.append(H)
                        }
                        m = h,
                            m >= u.length && i.classList.add("hidden")
                    }
                    , E = () => {
                        let h = s.value || ""
                            , v = new RegExp(h.replace(/[.*+?^${}()|[\]\\]/g, "\\$&"), "i");
                        u = Object.keys(d).filter(y => y === "" || y === a || (d[y] || "").search(v) !== -1).sort((y, H) => y === "" ? -1 : H === "" ? 1 : y === a ? -1 : H === a ? 1 : d[y].localeCompare(d[H])),
                            m = 0,
                            g(),
                            L()
                    }
                    ;
                g(),
                    E(),
                    t.addEventListener("scroll", h => {
                        let v = h.target;
                        v.scrollTop + v.clientHeight * window.devicePixelRatio >= v.scrollHeight && L()
                    }
                    ),
                    s.addEventListener("keyup", E),
                    s.addEventListener("search", E),
                    s.addEventListener("clear", E),
                    i.addEventListener("click", h => {
                        h.preventDefault(),
                            L()
                    }
                    )
            }
    };

    var ne = (e, r = !0) => {
        var l, i;
        let n = document.querySelector(e)
            , o = (i = (l = document.querySelector("#header .header-container")) == null ? void 0 : l.offsetHeight) != null ? i : 100
            , t = document.querySelector(".filter-button");
        if (!n)
            return;
        n.addEventListener("change", c => {
            var u;
            let a = c.target
                , d = a.closest("form");
            !a.name || !a.name.startsWith("filter") || !d || ((r || a.name === "filter[order_by]") && d.submit(),
                (u = d.querySelector(".submit-button-form")) == null || u.classList.add("show"))
        }
        );
        let s = 0;
        document.addEventListener("scroll", () => {
            s = window.scrollY,
                t == null || t.classList.toggle("fixed-bottom", s > o - 24)
        }
        ),
            te(e),
            ee(e),
            k(e, "advertiser_publish_date"),
            k(e, "duration"),
            k(e, "virtual_reality"),
            k(e, "quality"),
            k(e, "pricing"),
            k(e, "advertiser_site")
    };

    var oe = e => {
        var t, s;
        let r = (s = (t = document.querySelector("#header .header-container")) == null ? void 0 : t.offsetHeight) != null ? s : 100
            , n = document.querySelector(e);
        if (!n)
            return;
        let o = 0;
        document.addEventListener("scroll", () => {
            o = window.scrollY,
                n.classList.toggle("hidden", o <= r - 24)
        }),
        n.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            })
        })
    };

    // 评分处理
    var re = e => {
        document.addEventListener("click", r => {
            let n = r.target
                , o = n == null ? void 0 : n.closest(".rate-link")
                , t = n == null ? void 0 : n.closest(e);
            !o || !t || t.classList.add("rating-active")
        }),
        document.addEventListener("click", r => {
            let n = r.target;
            if (!n.classList.contains("item-rating-none") && !n.closest(".item-rating-none"))
                return;
            let o = n.closest(".item-rating-container");
            o && (r.preventDefault(),
                o.classList.add("item-rating-disabled"))
        }),
        document.addEventListener("click", r => {
            let n = r.target
                , o = n.closest(".item-rating-container");
            if (!o)
                return;
            let t = n.classList.contains("item-rating-option") ? n : n.closest(".item-rating-option")
                , s = t == null ? void 0 : t.dataset.postUrl;
            !t || !s || (r.preventDefault(),
                o.classList.add("item-rating-disabled"),
                t.classList.add("item-rating-clicked"),
                fetch(s, {
                    method: "post"
                }).then(l => {
                    if (l.status !== 200)
                        throw l.statusText
                }
                ).catch(() => {
                    o.classList.remove("item-rating-disabled"),
                        t.classList.remove("item-rating-clicked")
                }
                ))
        })
    };

    // 图片加载
    var se = e => {
        var n;
        let r = e.closest(".card");
        // r && ((n = r.querySelector(".no-image")) == null || n.classList.remove("hidden"),
        // r.classList.add("no-click"))
    };
    
    var le = e => {
        e.addEventListener("error", () => {
            se(e)
        }),
        e.complete && e.naturalWidth === 0 && se(e)
    }; 
    
    var ie = e => {
        for (let n of document.querySelectorAll(e)) {
            le(n)
        };

        new MutationObserver((n, o) => {
            for (let t of n) 
                for (let s of t.addedNodes)
                    if (s instanceof HTMLElement && s.classList.contains("card"))
                        for (let l of s.querySelectorAll(e))
                            le(l)
        }).observe(document.body, {
            childList: !0,
            subtree: !0
        })
    };
    var ce = e => e.value.trimStart().trimEnd().toLowerCase().replace(/\s+/g, " ");
    var ae = (e, r) => r === "" ? e : e.startsWith(r) ? "".concat(r, "<strong>").concat(e.substring(r.length), "</strong>") : "<strong>".concat(e, "</strong>");
    var Ae = (e, r) => {
        if (!e.fullscreen)
            return;
        let n = document.querySelector(e.trigger)
            , o = r.querySelector("input[type=search]")
            , t = document.querySelector(".fullscreen-search-wrapper")
            , s = t == null ? void 0 : t.querySelector(".close-autocomplete");
        if (!n || !o || !s || !t)
            return;
        n.addEventListener("click", () => {
            var i;
            (i = document.querySelector("body")) == null || i.classList.add("body-locked"),
                t == null || t.classList.add("show"),
                o == null || o.focus()
        }
        ),
            o.addEventListener("focus", () => {
                o.scrollIntoView()
            }
            );
        let l = () => {
            var c;
            (c = document.querySelector("body")) == null || c.classList.remove("body-locked"),
                t.classList.remove("show");
            let i = o.value;
            i && (n.value = i)
        }
            ;
        s.addEventListener("click", () => {
            l()
        }
        ),
        t.addEventListener("click", i => {
            i.stopPropagation()
        }
        ),
        t.querySelectorAll(".button-secondary").forEach(i => {
            i.addEventListener("click", () => {
                l()
            }
            )
        }
        ),
        r.addEventListener("submit", () => {
            l()
        }
        )
    };

    // 用户搜索
    var N = (e, r) => {
        // 获取 DOM 元素
        let n = document.querySelector(e);
        let o = n?.querySelector("input[type=search]");
        let t = n?.querySelector(".autocomplete");
        let s = n?.querySelector("template.search-ul-template");
        let l = n?.querySelector(".no-results");
    
        if (!n || !o || !t || !s || !l) {
            return;
        }
    
        r?.fullscreen && Ae(r, n);
        
        let i = n.dataset.url || "",
            c = -1,
            a,
            d = 0,
            u = 0,
            m = "";
            
        // 生成请求 URL
        let g = f => i.replace("__queryString__", encodeURIComponent(f));
            
        // 选中高亮项
        let L = () => {
            if (c === -1) return;
            let f = t.querySelector(".autocomplete-list .autocomplete-result.active");
            if (f) {
                o.value = f?.dataset.suggestion || "";
                t.innerHTML = "";
                c = -1;
            }
        };
            
        // 发送搜索请求
        let E = f => {
            let p = ce(o), M = g(p);
            fetch(M).then(S => {
                // S.json()
            }).then(S => {
                if (f > u) {
                    a = S || [];
                    y();
                    h();
                    u = f;
                }
            });
        };
            
        // 显示搜索结果框
        let h = () => {
            if (!t.classList.contains("show")) {
                t.classList.add("show");
                t.classList.remove("hidden");
            }
        };
            
        // 显示无搜索结果信息
        let v = () => {
            l.classList.add("show");
            l.querySelector("span strong").innerHTML = o.value.trimStart();
            l.addEventListener("click", () => {
                n.submit();
            });
        };
            
        // 处理搜索结果展示
        let y = () => {
            l.classList.remove("show");
            let f = ce(o).trim();
            if (!a?.results) {
                a = undefined;
                return;
            }
            c = -1;
            let p = t.querySelector("ul");
            if (!p) return;
            
            let M = f.split(" ");
            p.innerHTML = "";
            if (Object.values(a.results).flat().length === 0) {
                v();
                return;
            }
            
            for (let [S, w] of Object.entries(a.results)) {
                if (w.length === 0) continue;
                let T = H(s, w, M, a, S);
                p.appendChild(T);
            }
        };
            
        // 生成搜索结果分组
        let H = (f, p, M, S, w) => {
            let T = f.content.cloneNode(true);
            let b = T.querySelector("template.search-li-template");
            if (!b) return T;
            
            if (S.labels[w]) {
                T.querySelector(".title").textContent = S.labels[w];
            } else {
                T.querySelector(".group-header")?.classList.add("hidden");
            }
            
            T.querySelector(".group-header")?.addEventListener("click", F => {
                F.stopPropagation();
            });
            
            for (let F of p) {
                let qe = R(b, F, M);
                T.querySelector(".autocomplete-group-container")?.appendChild(qe);
            }
            
            b?.remove();
            return T;
        };
            
        // 生成搜索结果项
        let R = (f, p, M) => {
            let S = f.content.cloneNode(true);
            S.querySelector("li").dataset.suggestion = p.name;
            let w = "";
            for (let b of p.prefix_list) {
                w += `${ae(b.name, M[b.index] || "")} `;
            }
            w += ae(p.suggestion, M[M.length - 1]);
            S.querySelector("span.suggestion-value").innerHTML = w;
            
            for (let b of p.tag_list) {
                if (b === "show_18_plus_indicator") {
                    S.querySelector(".badge")?.classList.remove("hidden");
                }
            }
            
            S.querySelector("li").addEventListener("click", () => {
                o.value = p.name;
                t.innerHTML = "";
                t.classList.remove("show");
                n.dispatchEvent(new Event("submit", { bubbles: true, cancelable: true })) && n.submit();
            });
            
            return S;
        };
            
        // 处理输入框焦点事件
        let x = () => {
            d += 1;
            E(d);
            y();
        };
        
        // 处理输入事件
        let be = () => {
            if (o.value !== m) {
                m = o.value;
                d += 1;
                E(d);
            }
        };
        
        // 处理键盘导航
        let we = f => {
            if (f.key === "Enter") {
                L();
                return;
            }
            if (f.key !== "ArrowUp" && f.key !== "ArrowDown") return;
            f.preventDefault();
            
            let p = t.querySelectorAll(".autocomplete-list .autocomplete-result");
            if (p.length === 0) return;
            
            let M = f.key === "ArrowDown" ? 1 : -1;
            let c = (c + M) % p.length;
            if (c < 0) c = p.length - 1;
            
            p.forEach(S => S.classList.remove("active"));
            p[c].classList.add("active");
            h();
        };
        
        o.addEventListener("keyup", be);
        o.addEventListener("keydown", we);
        o.addEventListener("focus", x);
        o.addEventListener("trigger", x);
        document.addEventListener("click", f => {
            let p = f.target;
            if (p && t.innerHTML !== "" && !p.classList.contains("autocomplete") && p.tagName !== "INPUT") {
                t.classList.remove("show");
            }
        });
    };

    // 
    var de = e => {
        for (let r of document.querySelectorAll(e)) {
            r.href.substring(0, 7) === "mailto:" && (r.href = r.href.replace("%20[at]%20", "@").replace("%20[dot]%20", "."),
            r.innerHTML = r.innerHTML.replace(" [at] ", "@").replace(" [dot] ", "."))
        }
    };
    var _ = e => {
        let r = e.querySelector('input[type="checkbox"]');
        r && (r.checked = !r.checked, r.dispatchEvent(new Event("change")), A(r.checked, e))
    }; 
    
    var A = (e, r) => {
        let n = r.querySelector(".toggle-on-label"), o = r.querySelector(".toggle-off-label");
        n == null || n.classList.toggle("hidden", !e), o == null || o.classList.toggle("hidden", e)
    };

    var $ = "thumbWidth"
        , ue = e => {
            let r = q(30)
                , n = t => {
                    t ? (document.body.classList.add("large-thumbs"),
                        r.set($, "large")) : (document.body.classList.remove("large-thumbs"),
                            r.remove($))
                }
                , o = r.get($) === "large" || e;
            for (let t of document.querySelectorAll(".width-toggle")) {
                let s = t.querySelector('input[type="checkbox"]');
                if (!s)
                    return;
                t.addEventListener("click", () => {
                    _(t)
                }
                ),
                    s.addEventListener("change", () => {
                        n(s.checked)
                    }
                    ),
                    s.checked = o,
                    n(o),
                    A(o, t)
            }
        }
        ;

    // 警告弹窗
    var me = () => {
        var o, t;
        let e = document.getElementById("splash-page");
        if (!e)
            return;
        let r = !!B.get("splashPageAccepted")
            , n = new URLSearchParams(window.location.search).get("t");
        if (r) {
            document.documentElement.classList.remove("blurred");
            return
        }
        if (!n)
            e.classList.remove("hidden"),
                (o = document.querySelector("body")) == null || o.classList.add("body-locked"),
                (t = e.querySelector("button")) == null || t.addEventListener("click", () => {
                    var l;
                    document.documentElement.classList.remove("blurred"),
                        e.classList.add("hidden"),
                        (l = document.querySelector("body")) == null || l.classList.remove("body-locked");
                    let s = new FormData;
                    s.append("splash-page-accepted", "1"),
                        fetch("/set-splash-page-accepted", {
                            method: "post",
                            body: s
                        })
                }
                );
        else {
            document.documentElement.classList.remove("blurred");
            let s = new FormData;
            s.append("splash-page-accepted", "1"),
                s.append("expire-session", "1"),
                fetch("/set-splash-page-accepted", {
                    method: "post",
                    body: s
                })
        }
    };

    var fe = () => {
        var o;
        if (document.querySelectorAll(".site-suggestion").length === 0)
            return;
        let r = q(365)
            , n = "suggestion-alert-closed";
        if (!r.get(n))
            for (let t of document.querySelectorAll(".site-suggestion"))
                (o = t.querySelector(".btn-close")) == null || o.addEventListener("click", () => {
                    t.remove(),
                        r.set(n, "true")
                }
                ),
                    t.classList.remove("hidden")
    };

    var pe = e => {
        document.querySelectorAll(e).forEach(n => {
            let o = n.querySelector("input")
                , t = n.querySelector(".clear-search-icon");
            !o || !t || t.addEventListener("click", () => {
                o.value = "",
                    o.focus(),
                    o.dispatchEvent(new Event("clear"))
            }
            )
        }
    )};

    var ge = e => {
        document.readyState !== "loading" ? e() : document.addEventListener("DOMContentLoaded", e)
    };

    var Le = () => {
        let e = document.querySelectorAll(".accordion-button")
            , r = [];
        e.forEach(n => {
            let o = n.nextElementSibling;
            n.hasAttribute("data-default-open") && (o.classList.add("open"),
                n.classList.add("active"),
                r.push(o)),
                n.addEventListener("click", () => {
                    o.classList.contains("open") ? (o.classList.remove("open"),
                        n.classList.remove("active"),
                        r = r.filter(t => t !== o)) : (r.forEach(t => {
                            t.classList.remove("open");
                            let s = t.previousElementSibling;
                            s && s.classList.remove("active")
                        }
                        ),
                            o.classList.add("open"),
                            n.classList.add("active"),
                            r = [o])
                }
                )
        }
        )
    };

    var he = () => {
        let e = document.querySelectorAll(".panel");
        for (let r of e) {
            if (!r.hasAttribute("data-setting"))
                continue;
            let n = r.getAttribute("data-setting")
                , o = document.querySelector(".".concat(n, "-panel"));
            if (!o)
                continue;
            let t = o.querySelector(".selected");
            document.querySelectorAll('[data-panel-target="'.concat(n, '-panel"] .setting-text')).forEach(l => {
                var i;
                l.innerHTML = (i = t == null ? void 0 : t.getAttribute("data-label")) != null ? i : ""
            }
            )
        }
    };

    var V = "colorScheme"
    , Ee = () => {
        let e = q(365)
            , r = t => {
                document.documentElement.classList.toggle("dark", t === "dark"),
                    document.documentElement.classList.toggle("light", t === "light"),
                    e.set(V, t);
                let s = new FormData;
                s.append("color-scheme", t),
                    fetch("/set-color-scheme", {
                        method: "post",
                        body: s
                    }).then(l => l.text())
            }
            ;
        if (document.querySelectorAll(".color-scheme-toggle").length === 0) {
            e.remove(V);
            return
        }
        let n = e.get(V)
            , o = n || "light";
        n || window.matchMedia("(prefers-color-scheme: dark)").matches && (o = "dark");
        for (let t of document.querySelectorAll(".color-scheme-toggle")) {
            let s = t.querySelector('input[type="checkbox"]');
            if (!s)
                return;
            t.addEventListener("click", () => {
                _(t)
            }
            ),
                s.addEventListener("change", () => {
                    r(s.checked ? "dark" : "light")
                }
                ),
                s.checked = o === "dark",
                r(o),
                A(o === "dark", t)
        }
    };
        
    var ye = () => {
        var r;
        let e = (n, o, t) => {
            for (let s of document.querySelectorAll(o))
                s.addEventListener("click", l => {
                    let i = l.target;
                    if (!(i.classList.contains(t) || i.closest("." + t)))
                        return;
                    let c = i.dataset.tagValue;
                    typeof window.gtag == "function" && C(n, {
                        value: c
                    })
                }
                )
        };

        e("orientation-new", ".orientation-panel .menu-item", "orientation-panel"),
            e("pricing-new", ".pricing-panel .menu-item", "pricing-panel"),
            e("locale-new", ".language-panel .menu-item", "language-panel"),
            e("locale-button-new", ".language-panel-dropdown .menu-item", "language-panel-dropdown"),
            ve(".button.filter-button", "filter_button_press_new"),
            ve("#filter-flyout .submit-button-form", "filter_button_apply_new"),
            (r = document.querySelector(".show-more-searches-pill")) == null || r.addEventListener("click", () => {
                C("show-more-searches-click", {})
            }
            )
    }
    
    , ve = (e, r) => {
        for (let n of document.querySelectorAll(e))
            n.addEventListener("click", o => {
                C(r, {})
            }
            )
    }
    
    , C = (e, r) => {
        typeof window.gtag == "function" && window.gtag("event", e, r)
    };

    var Te = () => {
        let e = document.querySelectorAll(".pill-group.scrollable .pill-container");
        e.length !== 0 && e.forEach(r => {
            var i, c;
            let n = (i = r.parentNode) == null ? void 0 : i.querySelector(".pill-scroll-left")
                , o = (c = r.parentNode) == null ? void 0 : c.querySelector(".pill-scroll-right");
            if (!n || !o)
                return;
            let t, s = (a, d) => {
                Se(a, d),
                    t || (t = setInterval(() => Se(a, d), 100))
            }
                , l = () => {
                    t && (clearInterval(t),
                        t = void 0)
                }
                ;
            ["mouseup", "mouseleave"].forEach(a => {
                n.addEventListener(a, l),
                    o.addEventListener(a, l)
            }
            ),
                n.addEventListener("mousedown", () => s(r, -1)),
                o.addEventListener("mousedown", () => s(r, 1)),
                n.addEventListener("touchend", l),
                o.addEventListener("touchend", l),
                r.addEventListener("scroll", () => U(r)),
                U(r)
        })
    }

    , D = (e, r) => {
        let n = e.getBoundingClientRect()
            , o = r.getBoundingClientRect();
        return o.left >= n.left && o.right <= n.right
    }

    , Se = (e, r) => {
        let n = e.querySelectorAll(".pill"), o = Array.from(n), t = 8, s = 56, l;
        if (r > 0 ? l = o.findIndex(i => !D(e, i) && i.getBoundingClientRect().left > e.getBoundingClientRect().left) : (l = o.slice().reverse().findIndex(i => !D(e, i) && i.getBoundingClientRect().right < e.getBoundingClientRect().right),
            l !== -1 && (l = o.length - 1 - l)),
            l !== void 0 && l !== -1) {
            let i = o[l]
                , c = r > 0 ? i.offsetLeft + i.offsetWidth - e.clientWidth + s + t : i.offsetLeft - s - t;
            e.scrollTo({
                left: c,
                behavior: "smooth"
            })
        }
        U(e)
    }

    , U = e => {
        var d, u;
        let r = e.querySelectorAll(".pill")
            , n = (d = e.parentNode) == null ? void 0 : d.querySelector(".pill-scroll-left")
            , o = (u = e.parentNode) == null ? void 0 : u.querySelector(".pill-scroll-right")
            , t = r[0]
            , s = r[r.length - 1]
            , l = D(e, t)
            , i = D(e, s)
            , c = e.scrollLeft <= 2
            , a = Math.ceil(e.scrollLeft + e.clientWidth) >= Math.floor(e.scrollWidth);
        a && C("popular-searches-scrolled-end", {}),
            n.classList.toggle("hidden", c || l),
            o.classList.toggle("hidden", a || i)
    };

    var J = () => {
        document.querySelectorAll('[data-toggle="dropdown"]').forEach(e => e.classList.remove("show")),
            document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(e => e.classList.remove("show")),
            document.querySelectorAll(".dropdown-menu").forEach(e => e.classList.remove("show"))
    }, 
    
    P = (e, r) => {
        let n = document.documentElement.getAttribute("dir")
            , o = n === "rtl" ? e.offsetLeft - (r.offsetWidth - e.clientWidth) : e.offsetLeft;
        e.dataset.dropdownPlacement === "bottom-end" && (o = n !== "rtl" ? e.offsetLeft - (r.offsetWidth - e.clientWidth) : e.offsetLeft);
        let t = e.offsetTop + e.clientHeight + 2;
        return r.getBoundingClientRect().top + r.clientHeight >= window.innerHeight && (t = e.offsetTop - r.clientHeight - 2),
        {
            translateX: o,
            translateY: t
        }
    }, 
    
    He = () => {
        let e = null;
        for (let r of document.querySelectorAll(".dropdown-menu"))
            r.addEventListener("click", n => {
                n.stopPropagation()
            }
            );
        for (let r of [...document.querySelectorAll('[data-toggle="dropdown"]'), ...document.querySelectorAll('[data-bs-toggle="dropdown"]')])
            r.addEventListener("click", n => {
                J();
                let o = r.nextElementSibling;
                if (!o || e === o) {
                    J(),
                        e = null;
                    return
                }
                e = o,
                    r.classList.add("show"),
                    o.classList.add("show");
                let { translateX: t, translateY: s } = P(r, o);
                o.style.transform = "translate(".concat(t, "px, ").concat(s, "px)")
            }
            );
        document.addEventListener("click", r => {
            let n = r.target
                , o = n.closest('[data-toggle="dropdown"]')
                , t = n.closest('[data-bs-toggle="dropdown"]');
            !n || n.dataset.toggle === "dropdown" || o || t || (J(),
                e = null)
        }
        )
    };

    var Me = () => {
        for (let o of document.querySelectorAll(".desktop-navigation .dropdown-menu"))
            o.addEventListener("click", t => t.stopPropagation());
        let e = null
            , r = null
            , n = document.querySelectorAll(".desktop-navigation .dropdown");
        for (let o of n) {
            let t = o.querySelector('[data-toggle="dropdown"]')
                , s = o.querySelector('[data-bs-toggle="dropdown"]')
                , l = o.querySelector(".dropdown-menu");
            (t || s) && l && (o.addEventListener("mouseenter", async () => {
                r && (clearTimeout(r),
                    e && e.classList.remove("show")),
                    r = setTimeout(() => {
                        for (let i of n)
                            i !== o && i.classList.remove("show");
                        if (t) {
                            t.classList.add("show");
                            let { translateX: i, translateY: c } = P(t, l);
                            l.style.transform = "translate(".concat(i, "px, ").concat(c, "px)")
                        }
                        if (s) {
                            s.classList.add("show");
                            let { translateX: i, translateY: c } = P(s, l);
                            l.style.transform = "translate(".concat(i, "px, ").concat(c, "px)")
                        }
                        e = l,
                            l.classList.add("show")
                    }
                        , 200)
            }
            ),
                o.addEventListener("mouseleave", () => {
                    r && clearTimeout(r),
                        t == null || t.classList.remove("show"),
                        s == null || s.classList.remove("show"),
                        l.classList.remove("show"),
                        e === l && (e = null)
                }
                ))
        }
    };

    // 
    ge(() => {
        var o;
        let e = navigator.userAgent.toLowerCase();
        let r = document.querySelector("[name=viewport]");

        /iphone|ipad/.test(e) && r && r.setAttribute("content", "width=device-width, initial-scale=1, maximum-scale=1"),
            // N('form[name="search_query"]'),
            // N('form[name="search_query_mobile"]', {
            //     fullscreen: !0,
            //     trigger: "#search_query_mobile_trigger_query"
            // }),
            W(),
            // ne(".content-filter", !((o = document.querySelector(".filter-button")) != null && o.offsetParent)),
            Q(".tag-filter"),
            Z("form[name^=tag-] input"),
            de(".email-link"),
            G(".filter_advertiser_site_widget:not(.filter-options-partial) .filter-input-container input", ".filter_advertiser_site_widget", ".filter-setting"),
            oe(".scroll-top-btn"),
            // re(".card:not(.paid)"),
            z(),
            K(),
            ie(".item-link img"),
            ue(!1),
            Ee(),
            // me(),
            fe(),
            Te(),
            pe(".input-container"),
            Me(),
            He(),
            Le(),
            he(),
            ye()
    });
}
)();
/*! Bundled license information:

js-cookie/dist/js.cookie.mjs:
  (*! js-cookie v3.0.5 | MIT *)
*/
