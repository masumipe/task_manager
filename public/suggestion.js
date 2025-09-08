function getQuery(query,elementName) {
    let data = [{'Name': 'DESCO', 'Amount': '16000'},{'Name': 'WASA', 'Amount': '15000'},{'Name': 'Daroan Salary', 'Amount': '16000'},{'Name': 'Daroan Gas Bill', 'Amount': '1500'},{'Name': 'Sewerage', 'Amount': '1300'},{'Name': 'Night Guard', 'Amount': '1300'},{'Name': 'Diesel', 'Amount': '2700'}];
        const InputElement = document.getElementsByName(elementName);
        // let query=InputElement.value;
        console.log('query:', query);
        console.log('InputElement:', elementName);

        if (query.length < 2) {
            return;
        }
        async function fetchData() {
            try {
                console.log('Parsed JSON:', data); // Log the actual JSON data
                const suggestions = data.filter(data => data.Name.toLowerCase().includes(query.toLowerCase()));
                // Remove any existing suggestion boxes
                document.querySelectorAll('.suggestion-box').forEach(box => box.remove());
                if (suggestions.length === 0) {
                    return;
                }
                showSuggestions(InputElement, suggestions);
            } catch (error) {
                console.error('Error:', error);
            }
        }
        fetchData();
    }

function showSuggestions(InputElement,suggestions) {
        // const InputElement = document.getElementsByName('batch[0][description]');

        const suggestionBox = document.createElement('div');
        suggestionBox.classList.add('suggestion-box');
        suggestionBox.style.position = 'absolute';
        suggestionBox.style.backgroundColor = '#fff';
        suggestionBox.style.border = '1px solid #ccc';
        suggestionBox.style.zIndex = '1000';

        suggestions.forEach(suggestion => {
            const suggestionItem = document.createElement('div');
            suggestionItem.classList.add('suggestion-item');
            suggestionItem.style.padding = '8px';
            suggestionItem.style.cursor = 'pointer';
            suggestionItem.textContent = suggestion.Name;
            suggestionItem.addEventListener('click', function() {
                console.log('Selected suggestion:', suggestion);
                // InputElement.removeEventListener('input', getQuery);
                // const inputElem = document.getElementsByName(elementName);
                // InputElement[0].removeEventListener('input', getQuery);
                InputElement[0].value = suggestion.Name;
                // InputElement.value = suggestion.TenantID;
                suggestionBox.remove();
            });
            suggestionBox.appendChild(suggestionItem);
        });

        document.body.appendChild(suggestionBox);
        // const inputElem = InputElement[0];
        const rect = InputElement[0].getBoundingClientRect();
        suggestionBox.style.width = `${rect.width}px`;
        Popper.createPopper(InputElement[0] , suggestionBox, {
            placement: 'bottom-start',
            modifiers: [
                { name: 'offset', options: { offset: [0, 2] } },
                { name: 'preventOverflow', options: { boundary: 'viewport' } },
            ],
        });
    }
