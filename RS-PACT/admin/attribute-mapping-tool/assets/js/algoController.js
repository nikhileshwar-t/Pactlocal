"use strict";

const algoController = (() => {

    let score = [];
    let mappedAttributes = [];
    let array2D = [];
    let pimAttributesArray = [];
    let externalAttributesArray = [];

    let predictor = async(pimAttributes , externalAttributes) => {
        mappedAttributes = [];
        array2D = [];
        pimAttributesArray = [...(new Set(pimAttributes))];
        externalAttributesArray = [...(new Set(externalAttributes))];
        pimAttributesArray.forEach(element => {
            score = [];
            externalAttributesArray.forEach(ele => {
                score.push( Math.min(levenshteinDistanceAlgo.algorithm(element.shortName,ele.externalAttribute)
                                    ,levenshteinDistanceAlgo.algorithm(element.displayName,ele.externalAttribute)
                ));
            });
            array2D.push(score);
        });

        let store = [];
        let PIMAttrRow = -1;

        array2D.forEach(element => {
            //get index of the minimum distance in each row
            store = [];
            PIMAttrRow += 1;
            let index = element.indexOf(Math.min(...element));
            
            let test = 0
            array2D.forEach(ele => {                
                store.push(array2D[test][index])
                test += 1;
            });

            let scoreAndAttributes = [];
            let scoreAppendIterator = 0;
            element.forEach(ele => {
                scoreAndAttributes.push({
                    'pimattr': pimAttributesArray[PIMAttrRow],
                    'score' : ele,
                    'externalAttribute' : externalAttributesArray[scoreAppendIterator].externalAttribute,
                });
                scoreAppendIterator += 1;
            });
            //sort attributes based on score
            scoreAndAttributes.sort((a,b) => {
                return a.score - b.score;
            });
            
            if (pimAttributesArray[store.indexOf(Math.min(...store))].shortName === pimAttributesArray[PIMAttrRow].shortName) {
                mappedAttributes.push({
                    'externalAttribute' : externalAttributesArray[index].externalAttribute,
                    'pimAttribute' : pimAttributesArray[PIMAttrRow],
                    'score' : scoreAndAttributes
                })
            }
            else{
                mappedAttributes.push({
                    'externalAttribute' : null,
                    'pimAttribute' : pimAttributesArray[PIMAttrRow],
                    'score' : scoreAndAttributes
                })
            }
        });
        return mappedAttributes;
    }

    return {
        predictor : predictor
    }
})();