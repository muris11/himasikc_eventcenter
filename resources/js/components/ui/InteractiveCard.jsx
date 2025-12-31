import React, { useRef, useState } from 'react';

/**
 * InteractiveCard - Modern 3D Card with Tilt Effect
 * Features: 3D tilt on hover, glassmorphism, glow effect
 */
const InteractiveCard = ({ 
  children, 
  className = '', 
  glassEffect = false,
  glowEffect = false,
  tiltIntensity = 10,
  href = null,
  onClick = null
}) => {
  const cardRef = useRef(null);
  const [rotateX, setRotateX] = useState(0);
  const [rotateY, setRotateY] = useState(0);
  const [isHovered, setIsHovered] = useState(false);

  const handleMouseMove = (e) => {
    if (!cardRef.current) return;
    
    const card = cardRef.current;
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    const rotateXValue = ((y - centerY) / centerY) * -tiltIntensity;
    const rotateYValue = ((x - centerX) / centerX) * tiltIntensity;
    
    setRotateX(rotateXValue);
    setRotateY(rotateYValue);
  };

  const handleMouseEnter = () => {
    setIsHovered(true);
  };

  const handleMouseLeave = () => {
    setIsHovered(false);
    setRotateX(0);
    setRotateY(0);
  };

  const baseClasses = `
    relative rounded-2xl overflow-hidden
    transition-all duration-300 ease-out
    ${glassEffect ? 'glass backdrop-blur-xl' : 'bg-white'}
    ${glowEffect && isHovered ? 'shadow-glow-lg' : 'shadow-lg hover:shadow-xl'}
    border border-slate-200
    ${className}
  `;

  const cardStyle = {
    transform: `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(${isHovered ? 1.02 : 1})`,
    transition: 'transform 0.1s ease-out, box-shadow 0.3s ease-out',
  };

  const CardContent = () => (
    <div
      ref={cardRef}
      className={baseClasses}
      style={cardStyle}
      onMouseMove={handleMouseMove}
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
      onClick={onClick}
    >
      {/* Gradient overlay on hover */}
      {isHovered && (
        <div className="absolute inset-0 bg-gradient-to-br from-primary/5 to-secondary/5 pointer-events-none transition-opacity duration-300" />
      )}
      
      {/* Content */}
      <div className="relative z-10">
        {children}
      </div>
    </div>
  );

  if (href) {
    return (
      <a href={href} className="block">
        <CardContent />
      </a>
    );
  }

  return <CardContent />;
};

export default InteractiveCard;
