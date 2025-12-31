import React, { useState, useEffect, useRef } from 'react';

/**
 * MasonryGrid - Pinterest-style Masonry Layout
 * Responsive grid that auto-arranges items
 */
const MasonryGrid = ({ 
  children, 
  columns = { sm: 1, md: 2, lg: 3 },
  gap = 6,
  className = ''
}) => {
  const [columnCount, setColumnCount] = useState(columns.sm);
  const containerRef = useRef(null);

  useEffect(() => {
    const updateColumns = () => {
      const width = window.innerWidth;
      if (width >= 1024) {
        setColumnCount(columns.lg);
      } else if (width >= 768) {
        setColumnCount(columns.md);
      } else {
        setColumnCount(columns.sm);
      }
    };

    updateColumns();
    window.addEventListener('resize', updateColumns);
    return () => window.removeEventListener('resize', updateColumns);
  }, [columns]);

  const childrenArray = React.Children.toArray(children);
  const columnWrappers = Array.from({ length: columnCount }, () => []);

  // Distribute children across columns
  childrenArray.forEach((child, index) => {
    const columnIndex = index % columnCount;
    columnWrappers[columnIndex].push(child);
  });

  const gapClass = `gap-${gap}`;

  return (
    <div 
      ref={containerRef}
      className={`grid ${gapClass} ${className}`}
      style={{ 
        gridTemplateColumns: `repeat(${columnCount}, 1fr)`,
        gap: `${gap * 0.25}rem`
      }}
    >
      {columnWrappers.map((column, columnIndex) => (
        <div 
          key={columnIndex} 
          className="flex flex-col"
          style={{ gap: `${gap * 0.25}rem` }}
        >
          {column.map((item, itemIndex) => (
            <div key={itemIndex} className="masonry-item animate-fade-up">
              {item}
            </div>
          ))}
        </div>
      ))}
    </div>
  );
};

export default MasonryGrid;
