// 拖拉解析器

(function (doc, win) {
    
    win['$Directives'] =  {...win['$Directives'], ...{
        DragScroll: (el, binding, vnode) => {
            let isDragging = false;
            let ec = binding.value ? document.getElementById(binding.value) : null;

            // 原始
            let startMouseX, startMouseY;
            let startScrollLeft, startScrollTop;

            // 记录
            let lastMouseX, lastMouseY;

            // 惯性
            let velocityX = 0;
            let velocityY = 0;
            let friction  = 0.5;

            // 缓冲
            const animateScroll = ()=> {
                ec = ec??el.parentNode;
                const inertia = setInterval(function() {
                    if (Math.abs(velocityX) < 0.1 && Math.abs(velocityY) < 0.1) {
                        clearInterval(inertia);
                    } else {
                        ec.scrollLeft -= velocityX;
                        ec.scrollTop  -= velocityY;
                        velocityX     *= friction;
                        velocityY     *= friction;
                    }
                }, 20);
            }

            // 开始
            el.addEventListener('mousedown', function(event) {
                ec = ec??el.parentNode;
                isDragging      = true;

                startMouseX     = event.clientX;
                startMouseY     = event.clientY;

                startScrollLeft = ec.scrollLeft;
                startScrollTop  = ec.scrollTop;
            });

            // 移动
            let dragScrollExecuting = false;
            el.addEventListener('mousemove', function(event) {
                if (dragScrollExecuting) {
                    return false;
                } else {
                    dragScrollExecuting = true;
                }

                if (isDragging) {
                    ec = ec??el.parentNode;
                    el.classList.add('pointer-events');

                    const deltaX    = event.clientX - startMouseX;
                    const deltaY    = event.clientY - startMouseY;

                    lastMouseX      = event.clientX;
                    lastMouseY      = event.clientY;

                    ec.scrollLeft   -= deltaX;
                    ec.scrollTop    -= deltaY;

                    velocityX       = deltaX;
                    velocityY       = deltaY;
                }

                setTimeout(() => dragScrollExecuting = false, 20);
            });
    
            // 停止
            el.addEventListener('mouseup', function() {
                isDragging = false;
                animateScroll();
                el.classList.remove('pointer-events');
            });

            // 离开
            el.addEventListener('mouseleave', function() {
                if (isDragging) {
                    isDragging = false;
                    animateScroll();
                    el.classList.remove('pointer-events');
                }
            });
        }
    }}
})(document, window);
