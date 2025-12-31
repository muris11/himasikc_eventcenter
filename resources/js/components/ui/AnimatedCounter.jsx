import React, { useEffect, useRef, useState } from 'react';
import { useInView } from 'react-intersection-observer';

/**
 * AnimatedCounter - Count-up Animation Component
 * Animates numbers when they come into view
 */
const AnimatedCounter = ({ 
  end, 
  duration = 2000, 
  prefix = '', 
  suffix = '',
  decimals = 0,
  className = '',
  startOnMount = false
}) => {
  const [count, setCount] = useState(0);
  const [hasAnimated, setHasAnimated] = useState(false);
  const { ref, inView } = useInView({
    threshold: 0.3,
    triggerOnce: true,
  });

  useEffect(() => {
    if ((inView || startOnMount) && !hasAnimated) {
      setHasAnimated(true);
      const startTime = Date.now();
      const startValue = 0;
      const endValue = end;
      
      const animate = () => {
        const currentTime = Date.now();
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function (ease-out)
        const easeOut = 1 - Math.pow(1 - progress, 3);
        const currentCount = startValue + (endValue - startValue) * easeOut;
        
        setCount(currentCount);
        
        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          setCount(endValue);
        }
      };
      
      animate();
    }
  }, [inView, startOnMount, end, duration, hasAnimated]);

  const formattedCount = count.toLocaleString('id-ID', {
    minimumFractionDigits: decimals,
    maximumFractionDigits: decimals,
  });

  return (
    <span ref={ref} className={`font-bold tabular-nums ${className}`}>
      {prefix}{formattedCount}{suffix}
    </span>
  );
};

export default AnimatedCounter;
