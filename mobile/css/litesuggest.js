/*!
 * LiteSuggest v1
 *
 * MIT Licensed
 *
 * Copyright 2015 Arielle Chapin
 * github.com/ariellebryn
 * ariellechapin.me
 */
(function($) {
    /* ----- Globals ----- */
    var GROUP = ".litesuggest-group";
    var INPUT = GROUP + " input";
    var SUGGESTIONS_TEXT = "litesuggest-suggestions";
    var SUGGESTIONS = "." + SUGGESTIONS_TEXT;
    var UL = GROUP + " " + SUGGESTIONS + " ul";
    var OPEN = "litesuggest-open";
    var FOCUS = "litesuggest-focus";
    var CORRECT = "litesuggest-correct";

    /* ----- Helpers ----- */
    function encode(str) {
        return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    // Check if jquery selection returns anything
    $.fn.exists = function () {
        return this.length !== 0;
    }
    
    
    /* ----- TRIENODE ----- */

    /***
     * A node to be used in a trie.
     *      <char> val : the value of the node
     */
    var TrieNode = function(val) {
        this.value = val;
        this.children = {};
    }

    /***
     * Adds a child node to the current node.
     *      <TrieNode> childNode : the child node to be added
     *      Returns <bool> : true if the child was succesfully added, false otherwise 
     */
    TrieNode.prototype.addChild = function(childNode) {
        var childVal = childNode.value;

        if (!childVal || !childNode) {
            console.error("[LiteSuggest] ERROR: Attempting to add invalid child node to dictionary trie.");
            return false;
        }

        this.children[childVal] = childNode;
        return true;
    }

    /***
     * Checks if the current node has the given child.
     *      <TrieNode> childNode : the child node to be checked for
     *      Returns <bool> : true if the child is present in the current node, else otherwise
     */
    TrieNode.prototype.hasChild = function(childNode) {
        var childVal = childNode.value;
        return this.hasChildValue(childVal);
    }

    /***
     * Checks if the current node has the given child.
     *      childVal : the child value to be checked for
     *      Returns <bool> : true if the child value is present in the current node, else otherwise
     */
    TrieNode.prototype.hasChildValue = function(childVal) {
        childVal = childVal;
        if (this.children[childVal])
            return true;
        else
            return false;
    }

    /***
     * Gets a child ndoe based on the value.
     *      childVal : the child value to fetch the node of
     *      Returns <TrieNode> : the child node
     */
    TrieNode.prototype.getChild = function(childVal) {
        childVal = childVal;
        return this.children[childVal];
    }

    /***
     * Takes a child node and removes it from the current node's children.
     *      <TrieNode> childNode : the child node to be removed
     */
    TrieNode.prototype.removeChild = function(childNode) {
        var childVal = childNode.value;
        this.children[childVal] = null;
    }

    /***
     * Finds all the paths in the trie that can be formed from the current node.
     *      <String> prefix : the string to add on to the front of the paths
     *      Returns <String[]> : the words/word segments that are formed from the paths
     */
    TrieNode.prototype.findAllPaths = function(prefix) {
        var suggestions = []; var child;

        for (childVal in this.children) {
            if (childVal == '\0') {
                suggestions.push(prefix);
            } else {
                child = this.children[childVal];
                suggestions = suggestions.concat(child.findAllPaths(prefix + child.value));
            }
        }

        return suggestions;
    }
    
    
    /* ----- TRIE ----- */

    /***
     * A trie that holds words to be used as a dictionary for litesuggest.
     *      <String[]> words : the words to initialize the Trie
     */
    var Trie = function(words) {
        this.root = new TrieNode("");

        if (words) {
            for (i in words) {
                this.addWord(words[i]);
            }
        }
    }

    /***
     * Adds the given word to the trie.
     *      <String> word : the word to add to the trie
     */
    Trie.prototype.addWord = function(word) {
        var split = word.split("");
        var i = 0;
        var currentNode = this.root;
        while (currentNode.hasChildValue(split[i])) {
            split[i] = encode(split[i]);
            currentNode = currentNode.getChild(split[i]);
            i++;
            if (i >= split.length)
                return;
        }

        var newNode;
        while (i < split.length) {
            split[i] = encode(split[i]);
            newNode = new TrieNode(split[i]);
            currentNode.addChild(newNode);
            currentNode = newNode;
            i++;
        }

        // Add final character
        currentNode.addChild(new TrieNode('\0'));
    }

    /***
     * Finds word suggestions based on the given context.
     *      <String> context : the string written by the user so far
     *      Returns <String[]> : an array of suggestions
     */
    Trie.prototype.findSuggestions = function(context) {
        var split = context.split("");
        var suggestions = [];
        var currentNodes = [this.root];
        var nextNodes = [];
        var uc, lc;

        for (var i = 0; i < split.length; i++) {
            split[i] = encode(split[i]);
            uc = split[i].toUpperCase();
            lc = split[i].toLowerCase();

            for (var j = 0; j < currentNodes.length; j++) {
                currentNode = currentNodes[j];
                if (currentNode.hasChildValue(uc)) {
                    nextNodes.push(currentNode.getChild(uc));
                }
                if (currentNode.hasChildValue(lc)) {
                    nextNodes.push(currentNode.getChild(lc));
                } 
            }

            if (nextNodes.length == 0) {
                return suggestions;
            } else {
                currentNodes = nextNodes;
                nextNodes = [];
            }
        }

        for (i = 0; i < currentNodes.length; i++) {
            suggestions = suggestions.concat(currentNodes[i].findAllPaths(""));
        }
        return suggestions;
    }

    
    /* ----- LITESUGGEST ----- */

    /***
     * The actual suggestion handler.
     *      <Object> opts : the user's options
     */
    var LiteSuggest = function(opts) {
        this.trie = new Trie(opts.words);
        this.groupSelector = opts.groupSelector;

        // Put all the suggestions in the tabbables array
        this.tabbables = this.setArray();

        this.count = -1;
        this.name = "";
    }

    /***
     * Adds the suggestions to the dropdown.
     *      <String> line : the line that's been typed so far
     *      <String[]> suggs : the array of suggestions for line
     */
    LiteSuggest.prototype.applySuggestions = function(line, suggs) {
        var els = "";
        var suggestion = "";
        $.each(suggs, function(index, value) {
            line = encode(line);
            els += "<li id='" + line + value + "'>" + line + "<span class='" + CORRECT + "'>" + value + "</span>" + "</li>";
        });
        $(this.groupSelector + INPUT + "[name='" + this.name + "'] + " + SUGGESTIONS + " ul").html(els);
        $(this.groupSelector + INPUT + "[name='" + this.name + "'] + " + SUGGESTIONS).addClass(OPEN);
    }

    /***
     * Increment the count so it loops.
     *      <int> count : the index of the suggestion the user has keyed through
     *      <int> length : the number of suggestions
     *      Returns <int> : the new index
     */
    LiteSuggest.prototype.incrementCount = function(count, length) {
        if (count == length - 1) {
            return 0;
        } else {
            return count+1;
        }
    }

    /***
     * Decrement count so it loops.
     *      <int> count : the index of the suggestion the user has keyed through
     *      <int> length : the number of suggestions
     *      Returns <int> : the new index
     */
    LiteSuggest.prototype.decrementCount = function(count, length) {
        if (count == 0) {
            return length - 1;
        } else {
            return count-1;
        }
    }

    /***
     * Call to get suggestions.
     *      <String> context : the line written so far
     *      Returns <String[]> : the suggested suffixes
     */
    LiteSuggest.prototype.generateSuggestions = function(context) {
        return this.trie.findSuggestions(context);
    }

    /***
     * Set value of selection in input.
     *      <DOM Element> el : the selected suggestion
     *      Returns <int> : the new count index
     */
    LiteSuggest.prototype.setValue = function(el) {
        if (el != null) {
            $(this.groupSelector + INPUT + "[name='" + this.name + "']").val(el.attr('id'));
            $("." + FOCUS).removeClass(FOCUS);
        }
        $(this.groupSelector + INPUT + "[name='" + this.name + "'] + " + SUGGESTIONS).removeClass(OPEN);
        this.tabbables = [];
        return -1;
    }
    
    
    /* ----- PLUGIN ----- */

    /***
     * Sets the tabbables array, so that the arrows keys work with the list elements
     */
    LiteSuggest.prototype.setArray = function() {
        return $(this.groupSelector + INPUT + "[name='" + this.name + "'] + " + SUGGESTIONS + " ul li").map(function(){return $(this);}).get();
    }

    /***
     * Sets up the plugin.
     *      <Object> options : the plugin options
     *      Returns the list of litesuggest objects made
     */
    $.fn.litesuggest = function(options) {
        var opts = $.extend({}, $.fn.litesuggest.defaults, options);

        var liteSuggest = new LiteSuggest(opts);
        var suggestDiv = "<div class='" + SUGGESTIONS_TEXT + "'><ul></ul></div>";

        var ret;

        ret = this.each(function() {
            $(liteSuggest.groupSelector).each(function() {
                $(this).append(suggestDiv);
            });

            /* --- EVENT HANDLERS --- */
            // If selection is clicked
            $(this).find($(liteSuggest.groupSelector + UL)).on("click","li",function(){
                liteSuggest.count = liteSuggest.setValue($(this));
            });

            $(this).find($(liteSuggest.groupSelector + INPUT)).blur(function() {
                var suggestions = $(this).next();
                setTimeout(function(){
                    suggestions.removeClass(OPEN);
                    suggestions.find("." + FOCUS).removeClass(FOCUS);
                    liteSuggest.count = -1;
                }, 50);
            });

            $(this).find($(liteSuggest.groupSelector + INPUT)).focus(function() {
                liteSuggest.name = $(this).attr("name");
                if (liteSuggest.tabbables.length > 0) {
                    $(INPUT + "[name='" + name + "'] + " + SUGGESTIONS).addClass(OPEN);
                }
            });

            $(this).find($(liteSuggest.groupSelector + INPUT)).on("keyup", function (event) {
                // To traverse down the "dropdown"
                if (event.which == 40) {
                    if (liteSuggest.tabbables.length > 0 && $(SUGGESTIONS).hasClass(OPEN)) {
                        if (liteSuggest.count >= 0) {
                            liteSuggest.tabbables[liteSuggest.count].removeClass(FOCUS);
                        }

                        liteSuggest.count = liteSuggest.incrementCount(liteSuggest.count, liteSuggest.tabbables.length);
                        liteSuggest.tabbables[liteSuggest.count].addClass(FOCUS);
                    }
                } else if (event.which == 38) {
                    // To traverse up the "dropdown"
                    if (liteSuggest.tabbables.length > 0 && $(SUGGESTIONS).hasClass(OPEN)) {
                        if (liteSuggest.count < liteSuggest.tabbables.length && liteSuggest.count >= 0) {
                            liteSuggest.tabbables[liteSuggest.count].removeClass(FOCUS);
                        }

                        liteSuggest.count = liteSuggest.decrementCount(liteSuggest.count, liteSuggest.tabbables.length);
                        liteSuggest.tabbables[liteSuggest.count].addClass(FOCUS);
                    }
                } else if (event.which == 13 || event.which == 39) {
                    // If selection is chosen by enter
                    var focus = $("." + FOCUS);
                    if (focus.exists()) {
                        liteSuggest.count = liteSuggest.setValue(focus);
                    }
                } else {
                    // Call to liteSuggest for suggestions,
                    // get result and, if anything, 
                    // set as new suggestions
                    liteSuggest.name = $(this).attr("name");
                    var line = $(this).val();
                    if (line) {
                        var suggestions = liteSuggest.generateSuggestions(line);
                        if (suggestions != null && suggestions.length > 0) {
                            liteSuggest.applySuggestions(line, suggestions);
                            liteSuggest.tabbables = liteSuggest.setArray();
                            liteSuggest.count = -1;
                        } else {
                            liteSuggest.count = liteSuggest.setValue(null);
                        }
                    }				
                }
            });
        });


        return ret;
    }

    // Default options
    $.fn.litesuggest.defaults = {
        groupSelector: "",
        words: []
    };
}(jQuery));