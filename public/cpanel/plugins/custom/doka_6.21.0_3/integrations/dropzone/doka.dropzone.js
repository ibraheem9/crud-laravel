function useDokaWithDropzone(dzOptions, dokaOptions) {

    // try to load next item
    dokaOptions.onclose = function() {

        // Remove this item from the queue
        queue.shift();

        // Edit next item in queue
        editNextFile();
    }

    // Create a default Doka editor
    var doka = Doka.create(dokaOptions);

    // Map of original and transformed files
    var fileMap = new Map();

    // File queue to edit
    var queue = [];

    function editNextFile() {
        var next = queue[0];
        if (next) next();
    }

    function queueFile(dz, file, done) {

        // Queue for editing
        queue.push(function() {
            doka.edit(file)
                .then(function(output) {

                    // No output means cancelled, remove file from list
                    if (!output) return done();
                    
                    // Create new thumbnail
                    dz.createThumbnail(
                        output.file,
                        dz.options.thumbnailWidth,
                        dz.options.thumbnailHeight,
                        dz.options.thumbnailMethod,
                        false, 
                        function(dataURL) {
                            
                            // Update the thumbnail
                            dz.emit('thumbnail', file, dataURL);
        
                            // Return modified file to dropzone
                            done(undefined, output.file);
                        });
                    
                })
                .catch(function() {
                    done('error loading image');
                })
        });

        // If this is first item, let's open the editor immmidiately
        if (queue.length === 1) editNextFile();
    }

    // expose transformFile method
    dzOptions.accept = function(file, done) {
        queueFile(this, file, function(err, fileOut) {
            if (err) {
                return done(err);
            }

            if (fileOut) {
                fileMap.set(file, fileOut);
            }

            done();
        });
    }

    dzOptions.transformFile = function(file, done) {
        if (fileMap.has(file)) return done(fileMap.get(file));
        done(file);
    }

    return dzOptions;
};