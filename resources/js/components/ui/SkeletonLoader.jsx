import React from 'react';

/**
 * SkeletonLoader - Enhanced Loading Skeleton with Shimmer
 */
const SkeletonLoader = ({ 
  type = 'text',
  count = 1,
  className = '',
  width = '100%',
  height = null
}) => {
  const skeletons = {
    text: (
      <div className={`h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse ${className}`} style={{ width }} />
    ),
    
    title: (
      <div className={`h-8 bg-slate-200 dark:bg-slate-700 rounded animate-pulse ${className}`} style={{ width }} />
    ),
    
    circle: (
      <div className={`rounded-full bg-slate-200 dark:bg-slate-700 animate-pulse ${className}`} style={{ width: height || width, height: height || width }} />
    ),
    
    card: (
      <div className={`bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 p-6 ${className}`}>
        <div className="flex items-center mb-4">
          <div className="w-12 h-12 rounded-full bg-slate-200 dark:bg-slate-700 animate-pulse mr-4" />
          <div className="flex-1 space-y-2">
            <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-3/4" />
            <div className="h-3 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-1/2" />
          </div>
        </div>
        <div className="h-48 bg-slate-200 dark:bg-slate-700 rounded-lg animate-pulse mb-4" />
        <div className="space-y-2">
          <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse" />
          <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-5/6" />
          <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-4/6" />
        </div>
      </div>
    ),
    
    eventCard: (
      <div className={`bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 ${className}`}>
        <div className="h-48 bg-slate-200 dark:bg-slate-700 animate-pulse" />
        <div className="p-6 space-y-4">
          <div className="flex gap-2">
            <div className="h-6 w-20 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse" />
            <div className="h-6 w-24 bg-slate-200 dark:bg-slate-700 rounded-full animate-pulse" />
          </div>
          <div className="h-6 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-3/4" />
          <div className="space-y-2">
            <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse" />
            <div className="h-4 bg-slate-200 dark:bg-slate-700 rounded animate-pulse w-5/6" />
          </div>
          <div className="flex items-center justify-between pt-4 border-t border-slate-200 dark:border-slate-700">
            <div className="h-4 w-32 bg-slate-200 dark:bg-slate-700 rounded animate-pulse" />
            <div className="h-4 w-20 bg-slate-200 dark:bg-slate-700 rounded animate-pulse" />
          </div>
        </div>
      </div>
    ),
    
    image: (
      <div className={`bg-slate-200 dark:bg-slate-700 rounded-lg animate-pulse ${className}`} style={{ width, height: height || '200px' }} />
    ),
    
    button: (
      <div className={`h-10 bg-slate-200 dark:bg-slate-700 rounded-lg animate-pulse ${className}`} style={{ width: width || '120px' }} />
    ),
  };

  const items = Array.from({ length: count }, (_, i) => (
    <div key={i}>
      {skeletons[type] || skeletons.text}
    </div>
  ));

  return count === 1 ? items[0] : <div className="space-y-4">{items}</div>;
};

export default SkeletonLoader;
